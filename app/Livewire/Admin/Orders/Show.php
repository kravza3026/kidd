<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
class Show extends Component
{
    public Order $order;

    public int $status = 0;

    public string $notes = '';

    public function mount(Order $order): void
    {
        $this->authorize('view', $order);
        $this->order = $order->load('customer', 'items.variant', 'shipping', 'billing');
        $this->status = $order->status->value;
        $this->notes = (string) $order->notes;
    }

    public function updateStatus(): void
    {
        $this->authorize('update', $this->order);

        $this->validate([
            'status' => ['required', Rule::enum(OrderStatus::class)],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $this->order->update([
            'status' => OrderStatus::from($this->status),
            'notes' => $this->notes,
        ]);

        $this->dispatch('toast', type: 'success', message: __('Order updated.'));
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->order);
        $this->order->delete();

        session()->flash('success', __('Order deleted.'));
        $this->redirectRoute('admin.orders.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.orders.show', [
            'statuses' => collect(OrderStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->name])->all(),
        ]);
    }
}
