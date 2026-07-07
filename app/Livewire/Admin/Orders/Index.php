<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatus;
use App\Livewire\Concerns\WithDataTable;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Orders')]
class Index extends Component
{
    use WithDataTable;

    #[Url(history: true)]
    public string $status = '';

    public function mount(): void
    {
        $this->authorize('viewAny', Order::class);
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function delete(int $id): void
    {
        $order = Order::findOrFail($id);
        $this->authorize('delete', $order);
        $order->delete();

        $this->dispatch('toast', type: 'success', message: __('Order deleted.'));
    }

    public function render(): View
    {
        $sortable = ['id', 'order_number', 'total_amount', 'status', 'created_at'];
        $sort = in_array($this->sortField, $sortable, true) ? $this->sortField : 'id';

        $orders = Order::query()
            ->with('customer')
            ->when($this->status !== '', fn ($q) => $q->where('status', (int) $this->status))
            ->when($this->search !== '', function ($query) {
                $term = trim($this->search);
                $number = (int) preg_replace('/\D/', '', $term);
                $query->where(function ($q) use ($term, $number) {
                    if ($number > 0) {
                        $q->orWhere('order_number', $number);
                    }
                    $q->orWhereHas('customer', fn ($c) => $c->where('first_name', 'ilike', "%{$term}%")
                        ->orWhere('last_name', 'ilike', "%{$term}%")
                        ->orWhere('email', 'ilike', "%{$term}%"));
                });
            })
            ->orderBy($sort, $this->safeSortDirection())
            ->paginate($this->perPage);

        return view('livewire.admin.orders.index', [
            'orders' => $orders,
            'statuses' => collect(OrderStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->name])->all(),
        ]);
    }
}
