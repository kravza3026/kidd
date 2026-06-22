<?php

namespace App\Livewire\Admin\Inventory;

use App\Livewire\Concerns\WithDataTable;
use App\Models\Inventory;
use App\Models\ProductVariant;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Inventory')]
class Index extends Component
{
    use WithDataTable;

    #[Url]
    public bool $lowStockOnly = false;

    public function mount(): void
    {
        $this->authorize('viewAny', Inventory::class);
        $this->sortField = 'quantity';
        $this->sortDirection = 'asc';
    }

    public function updatedLowStockOnly(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $locale = app()->getLocale();
        $threshold = (int) config('admin.low_stock_threshold', 5);

        $rows = ProductVariant::query()
            ->with(['product', 'color', 'size'])
            ->when($this->search !== '', function ($q) {
                $term = '%'.$this->search.'%';
                $q->where(fn ($q) => $q
                    ->where('sku', 'ilike', $term)
                    ->orWhere('barcode', 'ilike', $term)
                    ->orWhereHas('product', fn ($p) => $p->where('name->'.app()->getLocale(), 'ilike', $term)));
            })
            ->when($this->lowStockOnly, fn ($q) => $q->where('quantity', '<=', $threshold))
            ->orderBy(in_array($this->sortField, ['quantity', 'sku']) ? $this->sortField : 'quantity', $this->safeSortDirection())
            ->paginate($this->perPage);

        return view('livewire.admin.inventory.index', [
            'rows' => $rows,
            'locale' => $locale,
            'threshold' => $threshold,
        ]);
    }
}
