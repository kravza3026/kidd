<?php

use App\Enums\AddressType;
use App\Livewire\Admin\Addresses\Manager;
use App\Models\City;
use App\Models\Customer;
use App\Models\Region;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    app()->setLocale('en');
});

function customerAddressManager(Customer $customer)
{
    return Livewire::test(Manager::class, [
        'addressableType' => Customer::class,
        'addressableId' => $customer->id,
    ]);
}

it('adds a polymorphic address to a customer', function () {
    actingAsAdmin();
    $customer = Customer::factory()->create();
    $region = Region::factory()->create();
    $city = City::factory()->create(['region_id' => $region->id]);

    customerAddressManager($customer)
        ->call('new')
        ->set('label', 'Home address')
        ->set('address_type', AddressType::Shipping->value)
        ->set('region_id', $region->id)
        ->set('city_id', $city->id)
        ->set('street_name', 'Stefan cel Mare')
        ->set('building', '12')
        ->set('is_default', true)
        ->call('save')
        ->assertHasNoErrors();

    $address = $customer->addresses()->sole();
    expect($address->label)->toBe('Home address')
        ->and($address->address_type)->toBe(AddressType::Shipping)
        ->and($address->is_default)->toBeTrue()
        ->and($address->addressable_id)->toBe($customer->id)
        ->and($address->addressable_type)->toBe($customer->getMorphClass());
});

it('keeps a single default per address type', function () {
    actingAsAdmin();
    $customer = Customer::factory()->create();
    $region = Region::factory()->create();
    $city = City::factory()->create(['region_id' => $region->id]);

    $first = $customer->addresses()->create([
        'label' => 'First', 'address_type' => AddressType::Shipping, 'is_default' => true,
        'region_id' => $region->id, 'city_id' => $city->id, 'street_name' => 'A', 'building' => '1',
    ]);
    $second = $customer->addresses()->create([
        'label' => 'Second', 'address_type' => AddressType::Shipping, 'is_default' => false,
        'region_id' => $region->id, 'city_id' => $city->id, 'street_name' => 'B', 'building' => '2',
    ]);

    customerAddressManager($customer)->call('makeDefault', $second->id);

    expect($second->fresh()->is_default)->toBeTrue()
        ->and($first->fresh()->is_default)->toBeFalse();
});

it('deletes a customer address', function () {
    actingAsAdmin();
    $customer = Customer::factory()->create();
    $region = Region::factory()->create();
    $city = City::factory()->create(['region_id' => $region->id]);
    $address = $customer->addresses()->create([
        'label' => 'Temp', 'address_type' => AddressType::Billing, 'is_default' => false,
        'region_id' => $region->id, 'city_id' => $city->id, 'street_name' => 'C', 'building' => '3',
    ]);

    customerAddressManager($customer)->call('delete', $address->id);

    expect($customer->addresses()->count())->toBe(0);
});

it('forbids a user who cannot update the customer', function () {
    $hr = User::factory()->create();
    $hr->assignRole('hr');
    $this->actingAs($hr);
    $customer = Customer::factory()->create();

    Livewire::test(Manager::class, [
        'addressableType' => Customer::class,
        'addressableId' => $customer->id,
    ])->assertForbidden();
});
