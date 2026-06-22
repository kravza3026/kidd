<?php

use App\Livewire\Admin\Cities;
use App\Livewire\Admin\Regions;
use App\Models\City;
use App\Models\Country;
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

it('lists regions', function () {
    actingAsAdmin();
    $region = Region::factory()->create();

    $this->get(route('admin.regions.index'))->assertOk()->assertSeeLivewire(Regions\Index::class);
    Livewire::test(Regions\Index::class)->assertSee($region->getTranslation('name', 'en'));
});

it('creates a region under a country', function () {
    actingAsAdmin();
    $country = Country::factory()->create();

    Livewire::test(Regions\Form::class)
        ->set('name.ro', 'Nord')->set('name.ru', 'Север')->set('name.en', 'North')
        ->set('code', 'nd')
        ->set('country_id', $country->id)
        ->call('save')
        ->assertRedirect(route('admin.regions.index'));

    $region = Region::query()->latest('id')->first();
    expect($region->getTranslation('name', 'en'))->toBe('North')
        ->and($region->code)->toBe('ND')
        ->and($region->country_id)->toBe($country->id);
});

it('creates a city under a region', function () {
    actingAsAdmin();
    $region = Region::factory()->create();

    Livewire::test(Cities\Form::class)
        ->set('name.ro', 'Chișinău')->set('name.ru', 'Кишинёв')->set('name.en', 'Chisinau')
        ->set('region_id', $region->id)
        ->call('save')
        ->assertRedirect(route('admin.cities.index'));

    $city = City::query()->latest('id')->first();
    expect($city->getTranslation('name', 'en'))->toBe('Chisinau')
        ->and($city->region_id)->toBe($region->id);
});

it('requires region name and code', function () {
    actingAsAdmin();

    Livewire::test(Regions\Form::class)
        ->set('name.en', '')->set('name.ro', '')->set('name.ru', '')
        ->set('code', '')
        ->call('save')
        ->assertHasErrors(['name.en', 'code']);
});

it('forbids a seller from regions', function () {
    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);

    $this->get(route('admin.regions.index'))->assertForbidden();
});
