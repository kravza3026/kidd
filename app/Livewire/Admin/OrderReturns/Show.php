<?php

namespace App\Livewire\Admin\OrderReturns;

use App\Enums\ReturnStatus;
use App\Models\OrderReturn;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
class Show extends Component
{
    public OrderReturn $orderReturn;

    public function mount(OrderReturn $orderReturn): void
    {
        $this->authorize('view', $orderReturn);
        $this->orderReturn = $orderReturn->load(['order.items.variant.product', 'order.items.variant.color', 'order.items.variant.size', 'customer', 'media']);
    }

    public function updateStatus(int $status): void
    {
        $this->authorize('update', $this->orderReturn);
        validator(['status' => $status], ['status' => [Rule::enum(ReturnStatus::class)]])->validate();

        $this->orderReturn->update(['status' => ReturnStatus::from($status)]);
        $this->orderReturn->refresh();

        $this->dispatch('toast', type: 'success', message: __('Return status updated.'));
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->orderReturn);
        $this->orderReturn->delete();

        session()->flash('success', __('Return request deleted.'));
        $this->redirectRoute('admin.order-returns.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.order-returns.show');
    }
}
