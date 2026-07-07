<?php

use App\Livewire\Admin\Vacancies\Form;
use App\Livewire\Admin\Vacancies\Index;
use App\Models\Company;
use App\Models\Location;
use App\Models\User;
use App\Models\Vacancy;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    app()->setLocale('en');
});

it('lists vacancies', function () {
    actingAsAdmin();
    $vacancy = Vacancy::factory()->create();

    $this->get(route('admin.vacancies.index'))->assertOk()->assertSeeLivewire(Index::class);
    Livewire::test(Index::class)->assertSee($vacancy->getTranslation('title', 'en'));
});

it('creates a vacancy with translations and an auto slug', function () {
    actingAsAdmin();
    $company = Company::factory()->create();
    $location = Location::factory()->create();

    Livewire::test(Form::class)
        ->set('fields.title.ro', 'Vânzător')
        ->set('fields.title.ru', 'Продавец')
        ->set('fields.title.en', 'Sales Associate')
        ->set('fields.summary.en', 'Great role')
        ->set('company_id', $company->id)
        ->set('location_id', $location->id)
        ->set('remote', true)
        ->call('save')
        ->assertRedirect(route('admin.vacancies.index'));

    $vacancy = Vacancy::query()->latest('id')->first();
    expect($vacancy->getTranslation('title', 'en'))->toBe('Sales Associate')
        ->and($vacancy->remote)->toBeTrue()
        ->and($vacancy->getTranslation('slug', 'en'))->not->toBeEmpty();
});

it('requires a title in every locale', function () {
    actingAsAdmin();

    Livewire::test(Form::class)
        ->set('fields.title.ro', '')->set('fields.title.ru', '')->set('fields.title.en', '')
        ->call('save')
        ->assertHasErrors(['fields.title.en']);
});

it('updates a vacancy', function () {
    actingAsAdmin();
    $vacancy = Vacancy::factory()->create();

    Livewire::test(Form::class, ['vacancy' => $vacancy])
        ->set('fields.title.en', 'Updated title')
        ->call('save')
        ->assertRedirect(route('admin.vacancies.index'));

    expect($vacancy->fresh()->getTranslation('title', 'en'))->toBe('Updated title');
});

it('soft-deletes a vacancy', function () {
    actingAsAdmin();
    $vacancy = Vacancy::factory()->create();

    Livewire::test(Index::class)->call('delete', $vacancy->id);

    expect(Vacancy::find($vacancy->id))->toBeNull();
});

it('lets HR manage vacancies but forbids a seller', function () {
    $hr = User::factory()->create();
    $hr->assignRole('hr');
    $this->actingAs($hr);
    $this->get(route('admin.vacancies.create'))->assertOk();

    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);
    $this->get(route('admin.vacancies.index'))->assertForbidden();
});
