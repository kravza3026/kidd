<?php

use App\Livewire\Admin\Users\Form;
use App\Livewire\Admin\Users\Index;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
});

it('lists users', function () {
    actingAsAdmin();
    $user = User::factory()->create();

    $this->get(route('admin.users.index'))->assertOk()->assertSeeLivewire(Index::class);
    Livewire::test(Index::class)->assertSee($user->email);
});

it('creates a staff user with roles', function () {
    actingAsAdmin();

    Livewire::test(Form::class)
        ->set('first_name', 'Vasile')
        ->set('last_name', 'Munteanu')
        ->set('email', 'vasile@kidd.md')
        ->set('phone', '+37360123456')
        ->set('password', 'secret123')
        ->set('roles', ['seller'])
        ->call('save')
        ->assertRedirect(route('admin.users.index'));

    $user = User::where('email', 'vasile@kidd.md')->first();
    expect($user)->not->toBeNull()
        ->and($user->hasRole('seller'))->toBeTrue();
});

it('requires core fields and password on create', function () {
    actingAsAdmin();

    Livewire::test(Form::class)
        ->set('first_name', '')
        ->set('email', 'bad')
        ->set('password', '')
        ->call('save')
        ->assertHasErrors(['first_name', 'last_name', 'email', 'password']);
});

it('updates a user and keeps password when blank', function () {
    actingAsAdmin();
    $user = User::factory()->create();
    $original = $user->password;

    Livewire::test(Form::class, ['user' => $user])
        ->set('first_name', 'Renamed')
        ->set('roles', ['manager'])
        ->call('save')
        ->assertRedirect(route('admin.users.index'));

    expect($user->fresh()->first_name)->toBe('Renamed')
        ->and($user->fresh()->password)->toBe($original)
        ->and($user->fresh()->hasRole('manager'))->toBeTrue();
});

it('forbids a manager from the users module', function () {
    $manager = User::factory()->create();
    $manager->assignRole('manager');
    $this->actingAs($manager);

    $this->get(route('admin.users.index'))->assertForbidden();
});
