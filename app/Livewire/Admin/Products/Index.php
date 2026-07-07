<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Concerns\WithDataTable;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Products')]
class Index extends Component
{
    use WithDataTable;

    public function mount(): void
    {
        $this->authorize('viewAny', Product::class);
    }

    public function delete(int $id): void
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
        $product->delete();

        $this->dispatch('toast', type: 'success', message: __('Product deleted.'));
    }

    public function render(): View
    {
        $locale = app()->getLocale();
        $sort = $this->sortField === 'name' ? "name->{$locale}" : $this->sortField;

        $products = Product::query()
            ->with(['category', 'gender'])
            ->withCount('variants')
            ->when($this->search !== '', fn ($query) => $query->where("name->{$locale}", 'ilike', '%'.$this->search.'%'))
            ->orderBy($sort, $this->safeSortDirection())
            ->paginate($this->perPage);

        return view('livewire.admin.products.index', compact('products'));
    }
}
