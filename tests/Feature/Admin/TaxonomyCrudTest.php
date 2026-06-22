<?php

use App\Livewire\Admin\Brands;
use App\Livewire\Admin\Fabrics;
use App\Livewire\Admin\Seasons;
use App\Models\Brand;
use App\Models\Fabric;
use App\Models\Season;
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

it('lists brands', function () {
    actingAsAdmin();
    $brand = Brand::factory()->create();

    $this->get(route('admin.brands.index'))->assertOk()->assertSeeLivewire(Brands\Index::class);
    Livewire::test(Brands\Index::class)->assertSee($brand->getTranslation('name', 'en'));
});

it('creates a brand with description and auto slug', function () {
    actingAsAdmin();

    Livewire::test(Brands\Form::class)
        ->set('name.ro', 'M')
        ->set('name.ru', 'M')
        ->set('name.en', 'MyBrand')
        ->set('description.en', 'Premium')
        ->set('sort_order', 5)
        ->call('save')
        ->assertRedirect(route('admin.brands.index'));

    $brand = Brand::query()->latest('id')->first();

    expect($brand->getTranslation('name', 'en'))->toBe('MyBrand')
        ->and($brand->getTranslation('description', 'en'))->toBe('Premium')
        ->and($brand->sort_order)->toBe(5)
        ->and($brand->getTranslation('slug', 'en'))->not->toBeEmpty();
});

it('requires a brand name', function () {
    actingAsAdmin();

    Livewire::test(Brands\Form::class)
        ->set('name.ro', '')->set('name.ru', '')->set('name.en', '')
        ->call('save')
        ->assertHasErrors(['name.en']);
});

it('creates then deletes a season', function () {
    actingAsAdmin();

    Livewire::test(Seasons\Form::class)
        ->set('name.ro', 'V')->set('name.ru', 'Л')->set('name.en', 'Summer')
        ->call('save')
        ->assertRedirect(route('admin.seasons.index'));

    $season = Season::query()->latest('id')->first();
    expect($season->getTranslation('name', 'en'))->toBe('Summer');

    Livewire::test(Seasons\Index::class)->call('delete', $season->id);
    expect(Season::find($season->id))->toBeNull();
});

it('edits a fabric', function () {
    actingAsAdmin();
    $fabric = Fabric::factory()->create();

    Livewire::test(Fabrics\Form::class, ['fabric' => $fabric])
        ->assertSet('recordId', $fabric->id)
        ->set('name.ro', 'x')->set('name.ru', 'y')->set('name.en', 'Linen X')
        ->call('save')
        ->assertRedirect(route('admin.fabrics.index'));

    expect($fabric->fresh()->getTranslation('name', 'en'))->toBe('Linen X');
});

it('forbids HR from taxonomy and 404s when a module is disabled', function () {
    $hr = User::factory()->create();
    $hr->assignRole('hr');
    $this->actingAs($hr);
    $this->get(route('admin.brands.index'))->assertForbidden();

    $this->actingAs(actingAsAdmin());
    config(['admin.modules.brand' => false]);
    $this->get(route('admin.brands.index'))->assertNotFound();
});
