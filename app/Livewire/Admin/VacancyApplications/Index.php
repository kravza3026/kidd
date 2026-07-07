<?php

namespace App\Livewire\Admin\VacancyApplications;

use App\Livewire\Concerns\WithDataTable;
use App\Models\VacancyApplication;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Applications')]
class Index extends Component
{
    use WithDataTable;

    public function mount(): void
    {
        $this->authorize('viewAny', VacancyApplication::class);
    }

    public function delete(int $id): void
    {
        $application = VacancyApplication::findOrFail($id);
        $this->authorize('delete', $application);
        $application->delete();

        $this->dispatch('toast', type: 'success', message: __('Application deleted.'));
    }

    public function render(): View
    {
        $sortable = ['id', 'first_name', 'email', 'created_at'];
        $sort = in_array($this->sortField, $sortable, true) ? $this->sortField : 'id';

        $applications = VacancyApplication::query()
            ->with('vacancy')
            ->when($this->search !== '', function ($query) {
                $term = '%'.$this->search.'%';
                $query->where(fn ($q) => $q->where('first_name', 'ilike', $term)
                    ->orWhere('last_name', 'ilike', $term)
                    ->orWhere('email', 'ilike', $term));
            })
            ->orderBy($sort, $this->safeSortDirection())
            ->paginate($this->perPage);

        return view('livewire.admin.vacancy-applications.index', compact('applications'));
    }
}
