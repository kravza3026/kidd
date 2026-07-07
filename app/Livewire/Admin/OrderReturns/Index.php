<?php

namespace App\Livewire\Admin\OrderReturns;

use App\Livewire\Concerns\WithDataTable;
use App\Models\OrderReturn;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Order returns')]
class Index extends Component
{
    use WithDataTable;

    public function mount(): void
    {
        $this->authorize('viewAny', OrderReturn::class);
    }

    public function delete(int $id): void
    {
        $return = OrderReturn::findOrFail($id);
        $this->authorize('delete', $return);
        $return->delete();

        $this->dispatch('toast', type: 'success', message: __('Return request deleted.'));
    }

    public function render(): View
    {
        $sortable = ['id', 'status', 'created_at'];
        $sort = in_array($this->sortField, $sortable, true) ? $this->sortField : 'id';

        $returns = OrderReturn::query()
            ->with(['order', 'customer'])
            ->when($this->search !== '', function ($query) {
                $term = '%'.$this->search.'%';
                $query->whereHas('order', fn ($q) => $q->where('order_number', 'ilike', $term))
                    ->orWhereHas('customer', fn ($q) => $q->where('first_name', 'ilike', $term)
                        ->orWhere('last_name', 'ilike', $term)
                        ->orWhere('email', 'ilike', $term));
            })
            ->orderBy($sort, $this->safeSortDirection())
            ->paginate($this->perPage);

        return view('livewire.admin.order-returns.index', compact('returns'));
    }
}
