<?php

use App\Enums\StockMovementType;
use App\Exceptions\InsufficientStockException;
use App\Models\Order;
use App\Models\StockMovement;
use App\Models\Warehouse;
use App\Services\InventoryService;

beforeEach(function () {
    $this->service = app(InventoryService::class);
});

it('records a receipt and increments the location and variant total', function () {
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();

    $movement = $this->service->record($variant, $warehouse, StockMovementType::Receipt, 30);

    expect($movement->quantity)->toBe(30)
        ->and($movement->type)->toBe(StockMovementType::Receipt)
        ->and($variant->inventories()->where('warehouse_id', $warehouse->id)->value('quantity'))->toBe(30)
        ->and($variant->fresh()->quantity)->toBe(30);
});

it('sums stock across warehouses into the variant total', function () {
    $variant = makeVariant();
    $w1 = Warehouse::factory()->create();
    $w2 = Warehouse::factory()->create();

    $this->service->record($variant, $w1, StockMovementType::Receipt, 10);
    $this->service->record($variant, $w2, StockMovementType::Receipt, 25);

    expect($variant->fresh()->quantity)->toBe(35)
        ->and($this->service->totalFor($variant))->toBe(35);
});

it('decrements on a sale', function () {
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();
    $this->service->record($variant, $warehouse, StockMovementType::Receipt, 20);

    $this->service->record($variant, $warehouse, StockMovementType::Sale, -8);

    expect($variant->fresh()->quantity)->toBe(12);
});

it('refuses to drive a location negative and rolls back the movement', function () {
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();
    $this->service->record($variant, $warehouse, StockMovementType::Receipt, 5);

    expect(fn () => $this->service->record($variant, $warehouse, StockMovementType::Sale, -9))
        ->toThrow(InsufficientStockException::class);

    expect($variant->fresh()->quantity)->toBe(5)
        ->and(StockMovement::where('type', StockMovementType::Sale)->count())->toBe(0);
});

it('sets an absolute level by recording the difference', function () {
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();
    $this->service->record($variant, $warehouse, StockMovementType::Receipt, 10);

    $movement = $this->service->setLevel($variant, $warehouse, 18);

    expect($movement->type)->toBe(StockMovementType::Adjustment)
        ->and($movement->quantity)->toBe(8)
        ->and($variant->fresh()->quantity)->toBe(18);
});

it('does nothing when setting a level to its current value', function () {
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();
    $this->service->record($variant, $warehouse, StockMovementType::Receipt, 10);

    $movement = $this->service->setLevel($variant, $warehouse, 10);

    expect($movement)->toBeNull()
        ->and(StockMovement::count())->toBe(1);
});

it('transfers stock between warehouses without changing the variant total', function () {
    $variant = makeVariant();
    $from = Warehouse::factory()->create();
    $to = Warehouse::factory()->create();
    $this->service->record($variant, $from, StockMovementType::Receipt, 40);

    [$out, $in] = $this->service->transfer($variant, $from, $to, 15);

    expect($out->quantity)->toBe(-15)
        ->and($in->quantity)->toBe(15)
        ->and($variant->inventories()->where('warehouse_id', $from->id)->value('quantity'))->toBe(25)
        ->and($variant->inventories()->where('warehouse_id', $to->id)->value('quantity'))->toBe(15)
        ->and($variant->fresh()->quantity)->toBe(40);
});

it('stores the reference and causer on a movement', function () {
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();
    $order = Order::factory()->create();
    $user = actingAsAdmin();

    $movement = $this->service->record($variant, $warehouse, StockMovementType::Sale, 5, 'fulfilment', $order, $user->id);

    expect($movement->note)->toBe('fulfilment')
        ->and($movement->user_id)->toBe($user->id)
        ->and($movement->reference->is($order))->toBeTrue();
});
