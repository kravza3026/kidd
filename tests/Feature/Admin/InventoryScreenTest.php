<?php

use App\Enums\StockMovementType;
use App\Livewire\Admin\Inventory\Index;
use App\Livewire\Admin\Inventory\Manage;
use App\Models\User;
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

it('lists variants with their stock for an admin', function () {
    actingAsAdmin();
    $variant = makeVariant();
    $variant->forceFill(['sku' => 'ZZ1234'])->save();

    $this->get(route('admin.inventory.index'))->assertOk()->assertSeeLivewire(Index::class);
    Livewire::test(Index::class)->assertSee('ZZ1234');
});

it('filters to low stock only', function () {
    actingAsAdmin();
    $low = makeVariant();
    $low->forceFill(['sku' => 'LOW001', 'quantity' => 2])->save();
    $high = makeVariant();
    $high->forceFill(['sku' => 'HIGH99', 'quantity' => 500])->save();

    Livewire::test(Index::class)
        ->set('lowStockOnly', true)
        ->assertSee('LOW001')
        ->assertDontSee('HIGH99');
});

it('receives stock from the manage screen and updates the total', function () {
    actingAsAdmin();
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();

    Livewire::test(Manage::class, ['variant' => $variant])
        ->set('receiveWarehouse', $warehouse->id)
        ->set('receiveQuantity', 40)
        ->call('receive');

    expect($variant->fresh()->quantity)->toBe(40);
});

it('adjusts a level to an absolute value', function () {
    actingAsAdmin();
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();
    $this->service->record($variant, $warehouse, StockMovementType::Receipt, 10);

    Livewire::test(Manage::class, ['variant' => $variant])
        ->set('adjustWarehouse', $warehouse->id)
        ->set('adjustLevel', 3)
        ->call('adjust');

    expect($variant->fresh()->quantity)->toBe(3);
});

it('transfers stock between warehouses', function () {
    actingAsAdmin();
    $variant = makeVariant();
    $from = Warehouse::factory()->create();
    $to = Warehouse::factory()->create();
    $this->service->record($variant, $from, StockMovementType::Receipt, 20);

    Livewire::test(Manage::class, ['variant' => $variant])
        ->set('transferFrom', $from->id)
        ->set('transferTo', $to->id)
        ->set('transferQuantity', 7)
        ->call('transfer')
        ->assertHasNoErrors();

    expect($variant->inventories()->where('warehouse_id', $to->id)->value('quantity'))->toBe(7);
});

it('shows an error when transferring more than available', function () {
    actingAsAdmin();
    $variant = makeVariant();
    $from = Warehouse::factory()->create();
    $to = Warehouse::factory()->create();
    $this->service->record($variant, $from, StockMovementType::Receipt, 3);

    Livewire::test(Manage::class, ['variant' => $variant])
        ->set('transferFrom', $from->id)
        ->set('transferTo', $to->id)
        ->set('transferQuantity', 9)
        ->call('transfer')
        ->assertHasErrors('transferQuantity');

    expect($variant->fresh()->quantity)->toBe(3);
});

it('forbids a role without any inventory permission from the index', function () {
    $hr = User::factory()->create();
    $hr->assignRole('hr');
    $this->actingAs($hr);

    $this->get(route('admin.inventory.index'))->assertForbidden();
});

it('lets a read-only seller view the index but not the manage screen', function () {
    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);
    $variant = makeVariant();

    $this->get(route('admin.inventory.index'))->assertOk();
    $this->get(route('admin.inventory.show', $variant->id))->assertForbidden();
});
