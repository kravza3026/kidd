<?php

namespace App\Livewire\Admin\Companies;

use App\Livewire\Concerns\WithDataTable;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Companies')]
class Index extends Component
{
    use WithDataTable;

    public function mount(): void
    {
        $this->authorize('viewAny', Company::class);
    }

    public function delete(int $id): void
    {
        $company = Company::findOrFail($id);
        $this->authorize('delete', $company);
        $company->delete();

        $this->dispatch('toast', type: 'success', message: __('Company deleted.'));
    }

    public function render(): View
    {
        $sortable = ['id', 'name', 'email', 'created_at'];
        $sort = in_array($this->sortField, $sortable, true) ? $this->sortField : 'id';

        $companies = Company::query()
            ->when($this->search !== '', function ($query) {
                $term = '%'.$this->search.'%';
                $query->where(fn ($q) => $q->where('name', 'ilike', $term)->orWhere('email', 'ilike', $term)->orWhere('idno', 'ilike', $term));
            })
            ->orderBy($sort, $this->safeSortDirection())
            ->paginate($this->perPage);

        return view('livewire.admin.companies.index', compact('companies'));
    }
}
