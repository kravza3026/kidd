<?php

use App\Livewire\Admin\Companies\Form;
use App\Livewire\Admin\Companies\Index;
use App\Models\Company;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
});

it('lists companies', function () {
    actingAsAdmin();
    $company = Company::factory()->create();

    $this->get(route('admin.companies.index'))->assertOk()->assertSeeLivewire(Index::class);
    Livewire::test(Index::class)->assertSee($company->name);
});

it('creates a company', function () {
    actingAsAdmin();

    Livewire::test(Form::class)
        ->set('name', 'Acme SRL')
        ->set('email', 'hi@acme.md')
        ->set('tva', 20)
        ->set('active', true)
        ->call('save')
        ->assertRedirect(route('admin.companies.index'));

    $company = Company::where('name', 'Acme SRL')->first();
    expect($company)->not->toBeNull()
        ->and((int) $company->status)->toBe(1);
});

it('requires a name', function () {
    actingAsAdmin();

    Livewire::test(Form::class)->set('name', '')->call('save')->assertHasErrors(['name']);
});

it('updates a company', function () {
    actingAsAdmin();
    $company = Company::factory()->create();

    Livewire::test(Form::class, ['company' => $company])
        ->set('name', 'Renamed Co')
        ->set('active', false)
        ->call('save')
        ->assertRedirect(route('admin.companies.index'));

    expect($company->fresh()->name)->toBe('Renamed Co')
        ->and((int) $company->fresh()->status)->toBe(0);
});

it('soft-deletes a company', function () {
    actingAsAdmin();
    $company = Company::factory()->create();

    Livewire::test(Index::class)->call('delete', $company->id);

    expect(Company::find($company->id))->toBeNull();
});

it('forbids a seller from companies', function () {
    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);

    $this->get(route('admin.companies.index'))->assertForbidden();
});
