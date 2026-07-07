<?php

use App\Livewire\Admin\Warehouses\Form;
use App\Livewire\Admin\Warehouses\Index;
use App\Models\User;
use App\Models\Warehouse;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    app()->setLocale('en');
});

it('lists warehouses', function () {
    actingAsAdmin();
    $warehouse = Warehouse::factory()->create();

    $this->get(route('admin.warehouses.index'))->assertOk()->assertSeeLivewire(Index::class);
    Livewire::test(Index::class)->assertSee($warehouse->code);
});

it('creates a warehouse', function () {
    actingAsAdmin();

    Livewire::test(Form::class)
        ->set('name.ro', 'Depozit')->set('name.ru', 'Склад')->set('name.en', 'Main Depot')
        ->set('code', 'mdl')
        ->call('save')
        ->assertRedirect(route('admin.warehouses.index'));

    $warehouse = Warehouse::query()->latest('id')->first();
    expect($warehouse->getTranslation('name', 'en'))->toBe('Main Depot')
        ->and($warehouse->code)->toBe('MDL');
});

it('requires name and a unique code', function () {
    actingAsAdmin();
    Warehouse::factory()->create(['code' => 'DUP']);

    Livewire::test(Form::class)
        ->set('name.en', '')->set('name.ro', '')->set('name.ru', '')
        ->set('code', 'DUP')
        ->call('save')
        ->assertHasErrors(['name.en', 'code']);
});

it('deletes a warehouse', function () {
    actingAsAdmin();
    $warehouse = Warehouse::factory()->create();

    Livewire::test(Index::class)->call('delete', $warehouse->id);

    expect(Warehouse::find($warehouse->id))->toBeNull();
});

it('forbids a seller from warehouses create', function () {
    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);

    $this->get(route('admin.warehouses.create'))->assertForbidden();
});
