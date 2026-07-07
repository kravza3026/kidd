<?php

namespace App\Livewire\Admin\Categories;

use App\Livewire\Concerns\WithDataTable;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Categories')]
class Index extends Component
{
    use WithDataTable;

    public function mount(): void
    {
        $this->authorize('viewAny', Category::class);
    }

    public function delete(int $id): void
    {
        $category = Category::findOrFail($id);
        $this->authorize('delete', $category);
        $category->delete();

        $this->dispatch('toast', type: 'success', message: __('Category deleted.'));
    }

    public function render(): View
    {
        $locale = app()->getLocale();
        $sort = $this->sortField === 'name' ? "name->{$locale}" : $this->sortField;

        $categories = Category::query()
            ->with('parent')
            ->when($this->search !== '', fn ($query) => $query->where("name->{$locale}", 'ilike', '%'.$this->search.'%'))
            ->orderBy($sort, $this->safeSortDirection())
            ->paginate($this->perPage);

        return view('livewire.admin.categories.index', compact('categories'));
    }
}
