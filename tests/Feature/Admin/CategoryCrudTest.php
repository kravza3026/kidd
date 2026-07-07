<?php

use App\Livewire\Admin\Categories\Form;
use App\Livewire\Admin\Categories\Index;
use App\Models\Category;
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

it('renders the index for an admin', function () {
    actingAsAdmin();
    $category = Category::factory()->create();

    $this->get(route('admin.categories.index'))
        ->assertOk()
        ->assertSeeLivewire(Index::class);

    Livewire::test(Index::class)
        ->assertOk()
        ->assertSee($category->getTranslation('name', 'en'));
});

it('searches categories', function () {
    actingAsAdmin();
    Category::factory()->create(['name' => ['ro' => 'Tricouri', 'ru' => 'Майки', 'en' => 'Tees']]);
    Category::factory()->create(['name' => ['ro' => 'Pantaloni', 'ru' => 'Штаны', 'en' => 'Pants']]);

    Livewire::test(Index::class)
        ->set('search', 'Tees')
        ->assertSee('Tees')
        ->assertDontSee('Pants');
});

it('sorts by a column', function () {
    actingAsAdmin();

    Livewire::test(Index::class)
        ->call('sortBy', 'name')
        ->assertSet('sortField', 'name')
        ->assertSet('sortDirection', 'asc')
        ->call('sortBy', 'name')
        ->assertSet('sortDirection', 'desc');
});

it('creates a category with translations and an auto slug', function () {
    actingAsAdmin();

    Livewire::test(Form::class)
        ->set('name.ro', 'Tricouri')
        ->set('name.ru', 'Футболки')
        ->set('name.en', 'T-shirts')
        ->set('description.en', 'Cotton tees')
        ->set('is_visible', true)
        ->call('save')
        ->assertRedirect(route('admin.categories.index'));

    $category = Category::query()->latest('id')->first();

    expect($category->getTranslation('name', 'en'))->toBe('T-shirts')
        ->and($category->getTranslation('name', 'ru'))->toBe('Футболки')
        ->and($category->getTranslation('slug', 'en'))->not->toBeEmpty()
        ->and($category->is_visible)->toBeTrue();
});

it('requires a name in every locale', function () {
    actingAsAdmin();

    Livewire::test(Form::class)
        ->set('name.ro', '')
        ->set('name.ru', '')
        ->set('name.en', '')
        ->call('save')
        ->assertHasErrors(['name.ro', 'name.en']);
});

it('updates a category', function () {
    actingAsAdmin();
    $category = Category::factory()->create(['is_visible' => true]);

    Livewire::test(Form::class, ['category' => $category])
        ->set('name.ro', 'Nou')
        ->set('name.ru', 'Новый')
        ->set('name.en', 'New name')
        ->set('is_visible', false)
        ->call('save')
        ->assertRedirect(route('admin.categories.index'));

    expect($category->fresh()->getTranslation('name', 'en'))->toBe('New name')
        ->and($category->fresh()->is_visible)->toBeFalse();
});

it('soft-deletes from the index', function () {
    actingAsAdmin();
    $category = Category::factory()->create();

    Livewire::test(Index::class)->call('delete', $category->id);

    expect(Category::find($category->id))->toBeNull()
        ->and(Category::withTrashed()->find($category->id))->not->toBeNull();
});

it('forbids a seller from the create form', function () {
    $user = User::factory()->create();
    $user->assignRole('seller');
    $this->actingAs($user);

    $this->get(route('admin.categories.create'))->assertForbidden();
});

it('redirects non-staff away from the admin panel', function () {
    $this->actingAs(User::factory()->create());

    $this->get(route('admin.categories.index'))->assertRedirect(route('home'));
});

it('404s when the category module is disabled', function () {
    actingAsAdmin();
    config(['admin.modules.category' => false]);

    $this->get(route('admin.categories.index'))->assertNotFound();
});
