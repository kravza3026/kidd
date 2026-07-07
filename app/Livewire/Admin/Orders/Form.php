<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\ShippingMethod;
use App\Models\Customer;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * Admin order builder: pick (or create) a customer, add variant line items with quantities
 * and prices, and create the order. Stock is deducted later when the order is moved to a
 * fulfilling status (see Orders\Show), so building a draft never touches inventory.
 */
#[Layout('layouts.admin.admin')]
#[Title('New order')]
class Form extends Component
{
    public ?int $customer_id = null;

    public bool $creatingCustomer = false;

    public string $new_first_name = '';

    public string $new_last_name = '';

    public string $new_email = '';

    public string $new_phone = '';

    /** @var array<int, array{variant_id: int, label: string, unit_price: float, quantity: int}> */
    public array $items = [];

    public string $variantSearch = '';

    public int $status = OrderStatus::Pending->value;

    public int $shipping_method = 1;

    public int $payment_method = 1;

    public string $notes = '';

    public function mount(): void
    {
        $this->authorize('create', Order::class);
    }

    /**
     * @return array<int, array{id: int, label: string}>
     */
    public function getVariantResultsProperty(): array
    {
        if (mb_strlen(trim($this->variantSearch)) < 2) {
            return [];
        }

        $term = '%'.$this->variantSearch.'%';
        $locale = app()->getLocale();

        return ProductVariant::query()
            ->with(['product', 'color', 'size'])
            ->where(fn ($q) => $q
                ->where('sku', 'ilike', $term)
                ->orWhere('barcode', 'ilike', $term)
                ->orWhereHas('product', function ($p) use ($term) {
                    $p->where(function ($p) use ($term) {
                        foreach (array_keys(config('app.locales')) as $loc) {
                            $p->orWhere('name->'.$loc, 'ilike', $term);
                        }
                    });
                }))
            ->limit(8)
            ->get()
            ->map(fn ($v) => ['id' => $v->id, 'label' => $this->variantLabel($v)])
            ->all();
    }

    public function addItem(int $variantId): void
    {
        if (collect($this->items)->contains('variant_id', $variantId)) {
            return;
        }

        $variant = ProductVariant::with(['product', 'color', 'size'])->findOrFail($variantId);

        $this->items[] = [
            'variant_id' => $variant->id,
            'label' => $this->variantLabel($variant),
            'unit_price' => ($variant->price_final ?: $variant->price_online) / 100,
            'quantity' => 1,
        ];

        $this->variantSearch = '';
    }

    public function removeItem(int $index): void
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function getTotalProperty(): float
    {
        return collect($this->items)->sum(fn ($i) => (float) $i['unit_price'] * (int) $i['quantity']);
    }

    public function save(): void
    {
        $data = $this->validate($this->rules());

        $customer = $this->resolveCustomer($data);

        $order = Order::create([
            'customer_id' => $customer->id,
            'tracking_id' => 1,
            'payment_id' => 1,
            'total_amount' => (int) round($this->total * 100),
            'status' => OrderStatus::from($this->status),
            'shipping_method' => ShippingMethod::from($this->shipping_method),
            'payment_method' => PaymentMethod::from($this->payment_method),
            'notes' => $this->notes,
        ]);

        foreach ($this->items as $item) {
            $variant = ProductVariant::find($item['variant_id']);
            $unit = (int) round($item['unit_price'] * 100);

            $order->items()->create([
                'product_variant_id' => $item['variant_id'],
                'variant_snapshot' => $variant?->toArray() ?? [],
                'quantity' => $item['quantity'],
                'unit_price' => $unit,
                'total_price' => $unit * (int) $item['quantity'],
            ]);
        }

        session()->flash('success', __('Order created.'));
        $this->redirectRoute('admin.orders.show', $order->id, navigate: true);
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        $rules = [
            'items' => ['required', 'array', 'min:1'],
            'items.*.variant_id' => ['required', 'integer', 'exists:product_variants,id'],
            'items.*.unit_price' => ['numeric', 'min:0', 'max:1000000'],
            'items.*.quantity' => ['integer', 'min:1', 'max:100000'],
            'status' => ['required', Rule::enum(OrderStatus::class)],
            'shipping_method' => ['required', Rule::enum(ShippingMethod::class)],
            'payment_method' => ['required', Rule::enum(PaymentMethod::class)],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];

        if ($this->creatingCustomer) {
            $rules['new_first_name'] = ['required', 'string', 'max:255'];
            $rules['new_last_name'] = ['required', 'string', 'max:255'];
            $rules['new_email'] = ['required', 'email', 'max:255'];
            $rules['new_phone'] = ['required', 'string', 'max:50'];
        } else {
            $rules['customer_id'] = ['required', 'integer', 'exists:customers,id'];
        }

        return $rules;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function resolveCustomer(array $data): Customer
    {
        if (! $this->creatingCustomer) {
            return Customer::findOrFail($this->customer_id);
        }

        return Customer::create([
            'company_id' => auth()->user()?->company_id ?? 1,
            'first_name' => $this->new_first_name,
            'last_name' => $this->new_last_name,
            'email' => $this->new_email,
            'phone' => $this->new_phone,
        ]);
    }

    protected function variantLabel(ProductVariant $variant): string
    {
        $locale = app()->getLocale();
        $name = $variant->product?->getTranslation('name', $locale) ?? __('Variant');
        $facets = trim(($variant->color?->getTranslation('name', $locale) ?? '').' '.($variant->size?->getTranslation('name', $locale) ?? ''));

        return trim($name.' · '.$facets.' · '.($variant->sku ?? ''), ' ·');
    }

    public function render(): View
    {
        return view('livewire.admin.orders.form', [
            'customers' => Customer::query()->orderBy('first_name')->limit(200)->get()
                ->mapWithKeys(fn ($c) => [$c->id => trim($c->first_name.' '.$c->last_name).' · '.$c->email]),
            'statuses' => collect(OrderStatus::cases())->mapWithKeys(fn ($c) => [$c->value => $c->label()])->all(),
            'shippingMethods' => collect(ShippingMethod::cases())->mapWithKeys(fn ($c) => [$c->value => $c->name])->all(),
            'paymentMethods' => collect(PaymentMethod::cases())->mapWithKeys(fn ($c) => [$c->value => $c->name])->all(),
            'variantResults' => $this->variantResults,
        ]);
    }
}
