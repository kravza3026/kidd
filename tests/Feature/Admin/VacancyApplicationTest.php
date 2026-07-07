<?php

use App\Livewire\Admin\VacancyApplications\Index;
use App\Livewire\Admin\VacancyApplications\Show;
use App\Models\User;
use App\Models\VacancyApplication;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
});

it('lists applications for an admin', function () {
    actingAsAdmin();
    $application = VacancyApplication::factory()->create();

    $this->get(route('admin.vacancy-applications.index'))->assertOk()->assertSeeLivewire(Index::class);
    Livewire::test(Index::class)->assertSee($application->email);
});

it('shows an application', function () {
    actingAsAdmin();
    $application = VacancyApplication::factory()->create(['first_name' => 'Maria']);

    Livewire::test(Show::class, ['application' => $application])->assertSee('Maria');
});

it('deletes an application', function () {
    actingAsAdmin();
    $application = VacancyApplication::factory()->create();

    Livewire::test(Index::class)->call('delete', $application->id);

    expect(VacancyApplication::find($application->id))->toBeNull();
});

it('lets HR manage applications but forbids a seller', function () {
    $hr = User::factory()->create();
    $hr->assignRole('hr');
    $this->actingAs($hr);
    $this->get(route('admin.vacancy-applications.index'))->assertOk();

    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);
    $this->get(route('admin.vacancy-applications.index'))->assertForbidden();
});

it('404s when the applications module is disabled', function () {
    actingAsAdmin();
    config(['admin.modules.vacancyApplication' => false]);

    $this->get(route('admin.vacancy-applications.index'))->assertNotFound();
});
