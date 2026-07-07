<?php

use App\Livewire\Admin\Orders\Form;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Money\Currency;
use Money\Money;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    app()->setLocale('en');
    Notification::fake();
});

function pricedVariant(int $minor = 5000): ProductVariant
{
    return ProductVariant::factory()->for(Product::factory())->create([
        'color_id' => Color::factory()->create()->id,
        'size_id' => Size::factory()->create()->id,
        'sku' => 'OB'.random_int(1000, 9999),
        'price_final' => new Money($minor, new Currency('MDL')),
    ]);
}

it('renders the order builder for an admin', function () {
    actingAsAdmin();

    $this->get(route('admin.orders.create'))
        ->assertOk()
        ->assertSeeLivewire(Form::class)
        ->assertSee('New order');
});

it('builds an order for an existing customer with line items', function () {
    actingAsAdmin();
    $customer = Customer::factory()->create();
    $variant = pricedVariant(5000); // 50.00

    Livewire::test(Form::class)
        ->set('customer_id', $customer->id)
        ->call('addItem', $variant->id)
        ->set('items.0.quantity', 3)
        ->call('save')
        ->assertHasNoErrors();

    $order = Order::query()->latest('id')->first();
    expect($order->customer_id)->toBe($customer->id)
        ->and($order->total_amount)->toBe(15000) // 3 × 50.00
        ->and($order->items)->toHaveCount(1)
        ->and($order->items->first()->quantity)->toBe(3)
        ->and($order->items->first()->unit_price)->toBe(5000)
        ->and($order->items->first()->total_price)->toBe(15000);
});

it('creates a new customer inline when building an order', function () {
    actingAsAdmin();
    $variant = pricedVariant();

    Livewire::test(Form::class)
        ->set('creatingCustomer', true)
        ->set('new_first_name', 'Ada')
        ->set('new_last_name', 'Lovelace')
        ->set('new_email', 'ada@example.com')
        ->set('new_phone', '+37360123456')
        ->call('addItem', $variant->id)
        ->call('save')
        ->assertHasNoErrors();

    $customer = Customer::query()->where('email', 'ada@example.com')->first();
    expect($customer)->not->toBeNull()
        ->and(Order::query()->latest('id')->first()->customer_id)->toBe($customer->id);
});

it('requires at least one line item', function () {
    actingAsAdmin();
    $customer = Customer::factory()->create();

    Livewire::test(Form::class)
        ->set('customer_id', $customer->id)
        ->call('save')
        ->assertHasErrors('items');
});

it('requires a customer when not creating one', function () {
    actingAsAdmin();
    $variant = pricedVariant();

    Livewire::test(Form::class)
        ->call('addItem', $variant->id)
        ->call('save')
        ->assertHasErrors('customer_id');
});

it('finds variants by sku in the picker', function () {
    actingAsAdmin();
    $variant = pricedVariant();
    $variant->update(['sku' => 'FINDME99']);

    $results = Livewire::test(Form::class)
        ->set('variantSearch', 'FINDME')
        ->get('variantResults');

    expect(collect($results)->pluck('id'))->toContain($variant->id);
});

it('forbids a driver without order create permission', function () {
    $driver = User::factory()->create();
    $driver->assignRole('driver');
    $this->actingAs($driver);

    $this->get(route('admin.orders.create'))->assertForbidden();
});
