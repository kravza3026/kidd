<?php

use App\Livewire\Admin\Customers\Form;
use App\Livewire\Admin\Customers\Index;
use App\Models\Company;
use App\Models\Customer;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
});

it('renders the index for an admin', function () {
    actingAsAdmin();
    $customer = Customer::factory()->create();

    $this->get(route('admin.customers.index'))
        ->assertOk()
        ->assertSeeLivewire(Index::class);

    Livewire::test(Index::class)->assertSee($customer->email);
});

it('creates a customer', function () {
    actingAsAdmin();
    $company = Company::factory()->create();

    Livewire::test(Form::class)
        ->set('first_name', 'Ion')
        ->set('last_name', 'Popescu')
        ->set('email', 'ion@example.com')
        ->set('phone', '+37360111222')
        ->set('company_id', $company->id)
        ->call('save')
        ->assertRedirect(route('admin.customers.index'));

    expect(Customer::where('email', 'ion@example.com')->exists())->toBeTrue();
});

it('requires the core fields', function () {
    actingAsAdmin();

    Livewire::test(Form::class)
        ->set('first_name', '')
        ->set('email', 'not-an-email')
        ->call('save')
        ->assertHasErrors(['first_name', 'last_name', 'email', 'phone']);
});

it('updates a customer', function () {
    actingAsAdmin();
    $customer = Customer::factory()->create();

    Livewire::test(Form::class, ['customer' => $customer])
        ->set('first_name', 'Renamed')
        ->call('save')
        ->assertRedirect(route('admin.customers.index'));

    expect($customer->fresh()->first_name)->toBe('Renamed');
});

it('soft-deletes a customer from the index', function () {
    actingAsAdmin();
    $customer = Customer::factory()->create();

    Livewire::test(Index::class)->call('delete', $customer->id);

    expect(Customer::find($customer->id))->toBeNull();
});

it('lets a seller manage customers (full perms per matrix)', function () {
    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);

    $this->get(route('admin.customers.index'))->assertOk();
    $this->get(route('admin.customers.create'))->assertOk();
});

it('forbids HR from customers', function () {
    $hr = User::factory()->create();
    $hr->assignRole('hr');
    $this->actingAs($hr);

    $this->get(route('admin.customers.index'))->assertForbidden();
});

it('404s when the customer module is disabled', function () {
    actingAsAdmin();
    config(['admin.modules.customer' => false]);

    $this->get(route('admin.customers.index'))->assertNotFound();
});
