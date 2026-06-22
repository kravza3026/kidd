<?php

use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
});

it('grants every ability to the admin role via Gate::before', function () {
    $user = User::factory()->create();
    $user->assignRole('admin');

    expect(Gate::forUser($user)->allows('product.create'))->toBeTrue()
        ->and(Gate::forUser($user)->allows('setting.update'))->toBeTrue()
        ->and(Gate::forUser($user)->allows('role.delete'))->toBeTrue();
});

it('limits a seller to their permission subset', function () {
    $user = User::factory()->create();
    $user->assignRole('seller');

    expect($user->can('order.update'))->toBeTrue()      // sellers manage orders
        ->and($user->can('product.viewAny'))->toBeTrue() // and read the catalog
        ->and($user->can('product.create'))->toBeFalse() // but cannot create products
        ->and($user->can('setting.update'))->toBeFalse(); // nor touch the platform
});

it('restricts HR to recruitment resources', function () {
    $user = User::factory()->create();
    $user->assignRole('hr');

    expect($user->can('vacancy.update'))->toBeTrue()
        ->and($user->can('contactInquire.view'))->toBeTrue()
        ->and($user->can('order.viewAny'))->toBeFalse();
});

it('denies a user with no role', function () {
    $user = User::factory()->create();

    expect($user->can('product.viewAny'))->toBeFalse()
        ->and($user->can('order.viewAny'))->toBeFalse();
});
