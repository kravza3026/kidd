<?php

use App\Livewire\Admin\Locations\Form;
use App\Livewire\Admin\Locations\Index;
use App\Models\Location;
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

it('lists locations', function () {
    actingAsAdmin();
    $location = Location::factory()->create();

    $this->get(route('admin.locations.index'))->assertOk()->assertSeeLivewire(Index::class);
    Livewire::test(Index::class)->assertSee($location->getTranslation('name', 'en'));
});

it('creates a store location', function () {
    actingAsAdmin();

    Livewire::test(Form::class)
        ->set('name.ro', 'Magazin')->set('name.ru', 'Магазин')->set('name.en', 'Flagship')
        ->set('type', Location::TYPE_STORE)
        ->call('save')
        ->assertRedirect(route('admin.locations.index'));

    $location = Location::query()->latest('id')->first();
    expect($location->getTranslation('name', 'en'))->toBe('Flagship')
        ->and((int) $location->type)->toBe(Location::TYPE_STORE);
});

it('requires a name', function () {
    actingAsAdmin();

    Livewire::test(Form::class)->set('name.en', '')->set('name.ro', '')->set('name.ru', '')->call('save')->assertHasErrors(['name.en']);
});

it('deletes a location', function () {
    actingAsAdmin();
    $location = Location::factory()->create();

    Livewire::test(Index::class)->call('delete', $location->id);

    expect(Location::find($location->id))->toBeNull();
});

it('forbids a seller from locations', function () {
    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);

    $this->get(route('admin.locations.index'))->assertForbidden();
});
