<?php

use App\Enums\AddressType;
use App\Models\Address;
use App\Models\City;
use App\Models\Region;
use App\Models\User;

function userAddress(User $user): Address
{
    $region = Region::factory()->create();
    $city = City::factory()->create(['region_id' => $region->id]);

    return $user->addresses()->create([
        'label' => 'Home',
        'address_type' => AddressType::Shipping,
        'region_id' => $region->id,
        'city_id' => $city->id,
        'street_name' => 'Str. A',
        'building' => '1',
    ]);
}

it('forbids deleting another user\'s address', function () {
    $address = userAddress(User::factory()->create());

    $this->actingAs(User::factory()->create())
        ->deleteJson(route('api.addresses.destroy', $address))
        ->assertForbidden();

    expect(Address::whereKey($address->id)->exists())->toBeTrue();
});

it('lets the owner delete their own address', function () {
    $owner = User::factory()->create();
    $address = userAddress($owner);

    $this->actingAs($owner)
        ->deleteJson(route('api.addresses.destroy', $address))
        ->assertNoContent();

    expect(Address::whereKey($address->id)->exists())->toBeFalse();
});

it('forbids setting another user\'s address as default', function () {
    $address = userAddress(User::factory()->create());

    $this->actingAs(User::factory()->create())
        ->putJson(route('api.addresses.default', $address))
        ->assertForbidden();

    expect($address->fresh()->is_default)->toBeFalse();
});

it('forbids updating another user\'s address', function () {
    $address = userAddress(User::factory()->create());

    $this->actingAs(User::factory()->create())
        ->putJson(route('api.addresses.update', $address), [
            'label' => 'Hacked',
            'address_type' => AddressType::Shipping->value,
            'region_id' => $address->region_id,
            'city_id' => $address->city_id,
            'street_name' => 'Evil St.',
            'building' => '9',
        ])
        ->assertForbidden();

    expect($address->fresh()->street_name)->toBe('Str. A');
});
