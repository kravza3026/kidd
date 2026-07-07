<?php

namespace App\Livewire\Admin\Customers;

use App\Livewire\Concerns\WithDataTable;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Customers')]
class Index extends Component
{
    use WithDataTable;

    public function mount(): void
    {
        $this->authorize('viewAny', Customer::class);
    }

    public function delete(int $id): void
    {
        $customer = Customer::findOrFail($id);
        $this->authorize('delete', $customer);
        $customer->delete();

        $this->dispatch('toast', type: 'success', message: __('Customer deleted.'));
    }

    public function render(): View
    {
        $sortable = ['id', 'first_name', 'last_name', 'email', 'created_at'];
        $sort = in_array($this->sortField, $sortable, true) ? $this->sortField : 'id';

        $customers = Customer::query()
            ->withCount('orders')
            ->when($this->search !== '', function ($query) {
                $term = '%'.$this->search.'%';
                $query->where(fn ($q) => $q->where('first_name', 'ilike', $term)
                    ->orWhere('last_name', 'ilike', $term)
                    ->orWhere('email', 'ilike', $term)
                    ->orWhere('phone', 'ilike', $term));
            })
            ->orderBy($sort, $this->safeSortDirection())
            ->paginate($this->perPage);

        return view('livewire.admin.customers.index', compact('customers'));
    }
}
