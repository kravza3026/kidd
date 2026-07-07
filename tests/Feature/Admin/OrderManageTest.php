<?php

use App\Enums\OrderStatus;
use App\Livewire\Admin\Orders\Index;
use App\Livewire\Admin\Orders\Show;
use App\Models\Order;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
});

it('renders the orders index', function () {
    actingAsAdmin();
    $order = Order::factory()->create();

    $this->get(route('admin.orders.index'))->assertOk()->assertSeeLivewire(Index::class);
    Livewire::test(Index::class)->assertSee($order->order_number);
});

it('filters orders by status', function () {
    actingAsAdmin();
    $pending = Order::factory()->create(['status' => OrderStatus::Pending]);
    $delivered = Order::factory()->create(['status' => OrderStatus::Delivered]);

    Livewire::test(Index::class)
        ->set('status', (string) OrderStatus::Delivered->value)
        ->assertSee($delivered->order_number)
        ->assertDontSee($pending->order_number);
});

it('updates order status and notes', function () {
    actingAsAdmin();
    $order = Order::factory()->create(['status' => OrderStatus::Pending]);

    Livewire::test(Show::class, ['order' => $order])
        ->set('status', OrderStatus::Delivered->value)
        ->set('notes', 'Shipped today')
        ->call('updateStatus');

    expect($order->fresh()->status)->toBe(OrderStatus::Delivered)
        ->and($order->fresh()->notes)->toBe('Shipped today');
});

it('deletes an order from the index', function () {
    actingAsAdmin();
    $order = Order::factory()->create();

    Livewire::test(Index::class)->call('delete', $order->id);

    expect(Order::find($order->id))->toBeNull();
});

it('lets a seller view orders but forbids HR', function () {
    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);
    $this->get(route('admin.orders.index'))->assertOk();

    $hr = User::factory()->create();
    $hr->assignRole('hr');
    $this->actingAs($hr);
    $this->get(route('admin.orders.index'))->assertForbidden();
});

it('404s when the order module is disabled', function () {
    actingAsAdmin();
    config(['admin.modules.order' => false]);

    $this->get(route('admin.orders.index'))->assertNotFound();
});
