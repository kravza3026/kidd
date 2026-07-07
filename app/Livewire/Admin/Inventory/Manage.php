<?php

namespace App\Livewire\Admin\Inventory;

use App\Enums\StockMovementType;
use App\Exceptions\InsufficientStockException;
use App\Models\ProductVariant;
use App\Models\Warehouse;
use App\Services\InventoryService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Manage stock')]
class Manage extends Component
{
    public ProductVariant $variant;

    // Receive
    public ?int $receiveWarehouse = null;

    public int $receiveQuantity = 1;

    public ?string $receiveNote = null;

    // Adjust to an absolute level
    public ?int $adjustWarehouse = null;

    public int $adjustLevel = 0;

    public ?string $adjustNote = null;

    // Transfer between warehouses
    public ?int $transferFrom = null;

    public ?int $transferTo = null;

    public int $transferQuantity = 1;

    public function mount(ProductVariant $variant): void
    {
        $this->authorize('inventory.update');
        $this->variant = $variant->load('product', 'color', 'size');
    }

    public function receive(InventoryService $service): void
    {
        $data = $this->validate([
            'receiveWarehouse' => ['required', 'integer', 'exists:warehouses,id'],
            'receiveQuantity' => ['required', 'integer', 'min:1', 'max:1000000'],
            'receiveNote' => ['nullable', 'string', 'max:255'],
        ]);

        $service->record(
            $this->variant,
            Warehouse::findOrFail($data['receiveWarehouse']),
            StockMovementType::Receipt,
            $data['receiveQuantity'],
            $data['receiveNote'],
            userId: auth()->id(),
        );

        $this->reset('receiveQuantity', 'receiveNote');
        $this->receiveQuantity = 1;
        $this->dispatch('toast', type: 'success', message: __('Stock received.'));
    }

    public function adjust(InventoryService $service): void
    {
        $data = $this->validate([
            'adjustWarehouse' => ['required', 'integer', 'exists:warehouses,id'],
            'adjustLevel' => ['required', 'integer', 'min:0', 'max:1000000'],
            'adjustNote' => ['nullable', 'string', 'max:255'],
        ]);

        $service->setLevel(
            $this->variant,
            Warehouse::findOrFail($data['adjustWarehouse']),
            $data['adjustLevel'],
            $data['adjustNote'],
            auth()->id(),
        );

        $this->reset('adjustNote');
        $this->dispatch('toast', type: 'success', message: __('Stock adjusted.'));
    }

    public function transfer(InventoryService $service): void
    {
        $data = $this->validate([
            'transferFrom' => ['required', 'integer', 'exists:warehouses,id'],
            'transferTo' => ['required', 'integer', 'different:transferFrom', 'exists:warehouses,id'],
            'transferQuantity' => ['required', 'integer', 'min:1', 'max:1000000'],
        ]);

        try {
            $service->transfer(
                $this->variant,
                Warehouse::findOrFail($data['transferFrom']),
                Warehouse::findOrFail($data['transferTo']),
                $data['transferQuantity'],
                userId: auth()->id(),
            );
        } catch (InsufficientStockException) {
            $this->addError('transferQuantity', __('Not enough stock in the source warehouse.'));

            return;
        }

        $this->reset('transferQuantity');
        $this->transferQuantity = 1;
        $this->dispatch('toast', type: 'success', message: __('Stock transferred.'));
    }

    public function render(): View
    {
        $locale = app()->getLocale();

        return view('livewire.admin.inventory.manage', [
            'warehouses' => Warehouse::orderBy('id')->get()->mapWithKeys(fn ($w) => [$w->id => $w->getTranslation('name', $locale)]),
            'levels' => $this->variant->inventories()->with('warehouse')->get(),
            'movements' => $this->variant->stockMovements()->with(['warehouse', 'user'])->latest()->limit(25)->get(),
        ]);
    }
}
