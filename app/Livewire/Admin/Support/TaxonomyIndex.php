<?php

namespace App\Livewire\Admin\Support;

use App\Livewire\Concerns\WithDataTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

/**
 * Shared index for simple translatable taxonomy resources (brands, seasons, fabrics, …).
 * Concrete subclasses declare their model, permission key, route prefix and columns.
 */
abstract class TaxonomyIndex extends Component
{
    use WithDataTable;

    /** @return class-string<Model> */
    abstract protected function modelClass(): string;

    abstract protected function resourceKey(): string;

    abstract protected function routePrefix(): string;

    abstract protected function title(): string;

    /** @return array<int, array{label: string, value: callable}> */
    abstract protected function columns(): array;

    protected function countRelation(): ?string
    {
        return 'products';
    }

    public function mount(): void
    {
        $this->authorize('viewAny', $this->modelClass());
    }

    public function delete(int $id): void
    {
        $model = $this->modelClass()::findOrFail($id);
        $this->authorize('delete', $model);
        $model->delete();

        $this->dispatch('toast', type: 'success', message: __('Deleted.'));
    }

    public function render(): View
    {
        $locale = app()->getLocale();
        $model = $this->modelClass();
        $sort = $this->sortField === 'name' ? "name->{$locale}" : $this->sortField;

        $query = $model::query();
        if ($this->countRelation()) {
            $query->withCount($this->countRelation());
        }
        $query
            ->when($this->search !== '', fn ($q) => $q->where("name->{$locale}", 'ilike', '%'.$this->search.'%'))
            ->orderBy($sort, $this->safeSortDirection());

        return view('livewire.admin.taxonomy.index', [
            'rows' => $query->paginate($this->perPage),
            'title' => $this->title(),
            'routePrefix' => $this->routePrefix(),
            'resource' => $this->resourceKey(),
            'columns' => $this->columns(),
        ]);
    }
}
