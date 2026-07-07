<?php

namespace App\Livewire\Admin\Products;

use App\Models\Color;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Support\Barcode;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Money\Currency;
use Money\Money;

/**
 * Full-page variant-matrix generator. The admin picks a set of colours and sizes; the
 * cartesian product becomes editable rows (auto SKU + EAN-13 barcode, prices, stock).
 * Re-generating preserves already-edited and persisted rows — it only appends new combos.
 *
 * Removing a row that has been ordered hides the variant rather than deleting it, so order
 * history is never orphaned (ProductVariant has no soft deletes).
 */
#[Layout('layouts.admin.admin')]
#[Title('Variant matrix')]
class Variants extends Component
{
    public Product $product;

    /** @var array<int, int> */
    public array $selectedColors = [];

    /** @var array<int, int> */
    public array $selectedSizes = [];

    /**
     * Generated/persisted variant rows.
     *
     * @var array<int, array{id: ?int, color_id: int, size_id: int, sku: string, barcode: string, price_online: float, price_final: float, quantity: int, is_visible: bool}>
     */
    public array $rows = [];

    public ?float $bulkPriceOnline = null;

    public ?float $bulkPriceFinal = null;

    public ?int $bulkQuantity = null;

    public function mount(Product $product): void
    {
        $this->authorize('update', $product);
        $this->product = $product;

        foreach ($product->variants()->orderBy('id')->get() as $variant) {
            $this->rows[] = $this->rowFromVariant($variant);
            $this->selectedColors[] = $variant->color_id;
            $this->selectedSizes[] = $variant->size_id;
        }

        $this->selectedColors = array_values(array_unique($this->selectedColors));
        $this->selectedSizes = array_values(array_unique($this->selectedSizes));
    }

    /**
     * Append a row for every selected colour × size combo that isn't present yet.
     */
    public function generate(): void
    {
        $existing = collect($this->rows)
            ->map(fn ($row) => $this->comboKey($row['color_id'], $row['size_id']))
            ->flip();

        foreach ($this->selectedColors as $colorId) {
            foreach ($this->selectedSizes as $sizeId) {
                $key = $this->comboKey((int) $colorId, (int) $sizeId);

                if ($existing->has($key)) {
                    continue;
                }

                $this->rows[] = [
                    'id' => null,
                    'color_id' => (int) $colorId,
                    'size_id' => (int) $sizeId,
                    'sku' => $this->uniqueSku(),
                    'barcode' => Barcode::generateUniqueEan13(),
                    'price_online' => 0.0,
                    'price_final' => 0.0,
                    'quantity' => 0,
                    'is_visible' => true,
                ];
                $existing->put($key, true);
            }
        }
    }

    public function removeRow(int $index): void
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);
    }

    /**
     * Copy any filled bulk value into every row.
     */
    public function applyBulk(): void
    {
        foreach ($this->rows as $i => $row) {
            if ($this->bulkPriceOnline !== null) {
                $this->rows[$i]['price_online'] = $this->bulkPriceOnline;
            }
            if ($this->bulkPriceFinal !== null) {
                $this->rows[$i]['price_final'] = $this->bulkPriceFinal;
            }
            if ($this->bulkQuantity !== null) {
                $this->rows[$i]['quantity'] = $this->bulkQuantity;
            }
        }
    }

    public function save(): void
    {
        $this->validate();

        $keptIds = [];

        foreach ($this->rows as $row) {
            $variant = $row['id']
                ? $this->product->variants()->findOrFail($row['id'])
                : $this->product->variants()->make();

            $variant->forceFill([
                'color_id' => $row['color_id'],
                'size_id' => $row['size_id'],
                'sku' => $row['sku'],
                'barcode' => $row['barcode'] ?: null,
                'quantity' => $row['quantity'],
                'is_visible' => $row['is_visible'],
                'price_online' => $this->toMoney($row['price_online']),
                'price_final' => $this->toMoney($row['price_final']),
            ]);
            $variant->save();

            $keptIds[] = $variant->id;
        }

        $this->reconcileRemovedVariants($keptIds);

        session()->flash('success', __('Variants saved.'));
        $this->redirectRoute('admin.products.show', $this->product->id, navigate: true);
    }

    /**
     * Hide ordered variants that were removed; hard-delete the rest.
     *
     * @param  array<int, int>  $keptIds
     */
    protected function reconcileRemovedVariants(array $keptIds): void
    {
        $removed = $this->product->variants()
            ->when($keptIds, fn ($q) => $q->whereNotIn('id', $keptIds))
            ->get();

        foreach ($removed as $variant) {
            if (OrderItem::query()->where('product_variant_id', $variant->id)->exists()) {
                $variant->update(['is_visible' => false]);
            } else {
                $variant->delete();
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'rows' => ['array'],
            'rows.*.sku' => ['required', 'string', 'max:50'],
            'rows.*.barcode' => ['nullable', 'string', 'max:64'],
            'rows.*.price_online' => ['numeric', 'min:0', 'max:1000000'],
            'rows.*.price_final' => ['numeric', 'min:0', 'max:1000000'],
            'rows.*.quantity' => ['integer', 'min:0', 'max:1000000'],
            'rows.*.is_visible' => ['boolean'],
        ];
    }

    public function render(): View
    {
        $locale = app()->getLocale();

        return view('livewire.admin.products.variants', [
            'colors' => Color::orderBy('sort_order')->get()->mapWithKeys(fn ($c) => [$c->id => $c->getTranslation('name', $locale)]),
            'sizes' => Size::orderBy('sort_order')->get()->mapWithKeys(fn ($s) => [$s->id => $s->getTranslation('name', $locale)]),
        ]);
    }

    /**
     * @return array{id: int, color_id: int, size_id: int, sku: string, barcode: string, price_online: float, price_final: float, quantity: int, is_visible: bool}
     */
    protected function rowFromVariant(ProductVariant $variant): array
    {
        return [
            'id' => $variant->id,
            'color_id' => $variant->color_id,
            'size_id' => $variant->size_id,
            'sku' => (string) $variant->sku,
            'barcode' => (string) $variant->barcode,
            'price_online' => $variant->price_online / 100,
            'price_final' => $variant->price_final / 100,
            'quantity' => (int) $variant->quantity,
            'is_visible' => (bool) $variant->is_visible,
        ];
    }

    protected function comboKey(int $colorId, int $sizeId): string
    {
        return $colorId.'-'.$sizeId;
    }

    protected function toMoney(float $major): Money
    {
        return new Money((int) round($major * 100), new Currency('MDL'));
    }

    /**
     * Generate an SKU (two letters + four digits) that no variant already uses.
     */
    protected function uniqueSku(): string
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        do {
            $sku = $letters[random_int(0, 25)].$letters[random_int(0, 25)].random_int(1000, 9999);
        } while (ProductVariant::query()->where('sku', $sku)->exists());

        return $sku;
    }
}
