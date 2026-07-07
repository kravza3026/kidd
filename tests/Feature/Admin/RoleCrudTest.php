<?php

use App\Livewire\Admin\Roles\Form;
use App\Livewire\Admin\Roles\Index;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
});

it('lists roles for an admin', function () {
    actingAsAdmin();

    $this->get(route('admin.roles.index'))->assertOk()->assertSeeLivewire(Index::class);
    Livewire::test(Index::class)->assertSee('manager');
});

it('creates a role with a permission matrix', function () {
    actingAsAdmin();

    Livewire::test(Form::class)
        ->set('name', 'editor')
        ->set('selected', ['product.viewAny', 'product.update', 'category.viewAny'])
        ->call('save')
        ->assertRedirect(route('admin.roles.index'));

    $role = Role::findByName('editor', 'web');
    expect($role->hasPermissionTo('product.update'))->toBeTrue()
        ->and($role->hasPermissionTo('category.viewAny'))->toBeTrue()
        ->and($role->hasPermissionTo('product.create'))->toBeFalse();
});

it('toggles all permissions of a resource', function () {
    actingAsAdmin();

    Livewire::test(Form::class)
        ->call('toggleResource', 'order')
        ->assertSet('selected', ['order.viewAny', 'order.view', 'order.create', 'order.update', 'order.delete'])
        ->call('toggleResource', 'order')
        ->assertSet('selected', []);
});

it('updates a role and syncs permissions', function () {
    actingAsAdmin();
    $role = Role::create(['name' => 'temp', 'guard_name' => 'web']);

    Livewire::test(Form::class, ['role' => $role])
        ->set('selected', ['customer.viewAny'])
        ->call('save')
        ->assertRedirect(route('admin.roles.index'));

    expect($role->fresh()->hasPermissionTo('customer.viewAny'))->toBeTrue();
});

it('protects the admin role from deletion', function () {
    actingAsAdmin();
    $admin = Role::findByName('admin', 'web');

    Livewire::test(Index::class)->call('delete', $admin->id);

    expect(Role::findByName('admin', 'web'))->not->toBeNull();
});

it('forbids a manager from the roles UI', function () {
    $manager = User::factory()->create();
    $manager->assignRole('manager');
    $this->actingAs($manager);

    $this->get(route('admin.roles.index'))->assertForbidden();
});
