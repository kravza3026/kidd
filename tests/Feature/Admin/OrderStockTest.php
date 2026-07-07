<?php

use App\Enums\OrderStatus;
use App\Enums\StockMovementType;
use App\Livewire\Admin\Orders\Show;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\StockMovement;
use App\Models\Warehouse;
use App\Services\InventoryService;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    app()->setLocale('en');
    $this->service = app(InventoryService::class);
});

function orderForVariant(ProductVariant $variant, int $quantity): Order
{
    $order = Order::factory()->create(['status' => OrderStatus::New, 'stock_committed' => false]);
    OrderItem::factory()->for($order)->create(['product_variant_id' => $variant->id, 'quantity' => $quantity]);

    return $order->load('items');
}

it('deducts stock from warehouses when an order is committed', function () {
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();
    $this->service->record($variant, $warehouse, StockMovementType::Receipt, 20);
    $order = orderForVariant($variant, 5);

    $this->service->commitOrder($order);

    expect($variant->fresh()->quantity)->toBe(15)
        ->and($order->fresh()->stock_committed)->toBeTrue()
        ->and(StockMovement::where('type', StockMovementType::Sale)->where('reference_id', $order->id)->sum('quantity'))->toBe(-5);
});

it('materialises denormalised variant stock into inventory on first sale', function () {
    Warehouse::factory()->create();
    $variant = makeVariant();
    $variant->forceFill(['quantity' => 10])->save();
    $order = orderForVariant($variant, 4);

    $this->service->commitOrder($order);

    expect($variant->fresh()->quantity)->toBe(6)
        ->and($variant->inventories()->sum('quantity'))->toBe(6);
});

it('does not double-deduct when committed twice', function () {
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();
    $this->service->record($variant, $warehouse, StockMovementType::Receipt, 20);
    $order = orderForVariant($variant, 5);

    $this->service->commitOrder($order);
    $this->service->commitOrder($order->fresh()->load('items'));

    expect($variant->fresh()->quantity)->toBe(15);
});

it('restores stock when a committed order is released', function () {
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();
    $this->service->record($variant, $warehouse, StockMovementType::Receipt, 20);
    $order = orderForVariant($variant, 5);

    $this->service->commitOrder($order);
    $this->service->releaseOrder($order->fresh()->load('items'));

    expect($variant->fresh()->quantity)->toBe(20)
        ->and($order->fresh()->stock_committed)->toBeFalse();
});

it('deducts only what is available and never goes negative', function () {
    Warehouse::factory()->create();
    $variant = makeVariant();
    $variant->forceFill(['quantity' => 3])->save();
    $order = orderForVariant($variant, 10);

    $this->service->commitOrder($order);

    expect($variant->fresh()->quantity)->toBe(0);
});

it('commits stock when an admin ships an order and restocks when cancelled', function () {
    actingAsAdmin();
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();
    $this->service->record($variant, $warehouse, StockMovementType::Receipt, 30);
    $order = orderForVariant($variant, 8);

    Livewire::test(Show::class, ['order' => $order])
        ->set('status', OrderStatus::Shipped->value)
        ->call('updateStatus');

    expect($variant->fresh()->quantity)->toBe(22);

    Livewire::test(Show::class, ['order' => $order->fresh()])
        ->set('status', OrderStatus::Canceled->value)
        ->call('updateStatus');

    expect($variant->fresh()->quantity)->toBe(30);
});
