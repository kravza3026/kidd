<?php

namespace App\Livewire\Admin\Vacancies;

use App\Livewire\Concerns\WithDataTable;
use App\Models\Vacancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Vacancies')]
class Index extends Component
{
    use WithDataTable;

    public function mount(): void
    {
        $this->authorize('viewAny', Vacancy::class);
    }

    public function delete(int $id): void
    {
        $vacancy = Vacancy::findOrFail($id);
        $this->authorize('delete', $vacancy);
        $vacancy->delete();

        $this->dispatch('toast', type: 'success', message: __('Vacancy deleted.'));
    }

    public function render(): View
    {
        $locale = app()->getLocale();
        $sort = $this->sortField === 'title' ? "title->{$locale}" : (in_array($this->sortField, ['id', 'created_at'], true) ? $this->sortField : 'id');

        $vacancies = Vacancy::query()
            ->with(['company', 'location'])
            ->withCount('applications')
            ->when($this->search !== '', fn ($q) => $q->where("title->{$locale}", 'ilike', '%'.$this->search.'%'))
            ->orderBy($sort, $this->safeSortDirection())
            ->paginate($this->perPage);

        return view('livewire.admin.vacancies.index', compact('vacancies'));
    }
}
