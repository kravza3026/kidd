<?php

use App\Livewire\Admin\Products\Form;
use App\Livewire\Admin\Products\Index;
use App\Models\Category;
use App\Models\Gender;
use App\Models\Product;
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
    $product = Product::factory()->create();

    $this->get(route('admin.products.index'))
        ->assertOk()
        ->assertSeeLivewire(Index::class);

    Livewire::test(Index::class)->assertSee($product->getTranslation('name', 'en'));
});

it('creates a product with relations, flags and an auto slug', function () {
    actingAsAdmin();
    $category = Category::factory()->create();
    $gender = Gender::factory()->create();

    Livewire::test(Form::class)
        ->set('name.ro', 'Tricou')
        ->set('name.ru', 'Майка')
        ->set('name.en', 'Tee')
        ->set('category_id', $category->id)
        ->set('gender_id', $gender->id)
        ->set('is_featured', true)
        ->call('save')
        ->assertRedirect(route('admin.products.index'));

    $product = Product::query()->latest('id')->first();

    expect($product->getTranslation('name', 'en'))->toBe('Tee')
        ->and($product->category_id)->toBe($category->id)
        ->and($product->gender_id)->toBe($gender->id)
        ->and($product->is_featured)->toBeTrue()
        ->and($product->getTranslation('slug', 'en'))->not->toBeEmpty();
});

it('requires name, category and gender', function () {
    actingAsAdmin();

    Livewire::test(Form::class)
        ->set('name.ro', '')
        ->set('name.ru', '')
        ->set('name.en', '')
        ->call('save')
        ->assertHasErrors(['name.en', 'category_id', 'gender_id']);
});

it('updates a product', function () {
    actingAsAdmin();
    $product = Product::factory()->create(['is_visible' => true]);

    Livewire::test(Form::class, ['product' => $product])
        ->set('name.ro', 'x')
        ->set('name.ru', 'y')
        ->set('name.en', 'Renamed')
        ->set('is_visible', false)
        ->call('save')
        ->assertRedirect(route('admin.products.index'));

    expect($product->fresh()->getTranslation('name', 'en'))->toBe('Renamed')
        ->and($product->fresh()->is_visible)->toBeFalse();
});

it('soft-deletes a product from the index', function () {
    actingAsAdmin();
    $product = Product::factory()->create();

    Livewire::test(Index::class)->call('delete', $product->id);

    expect(Product::find($product->id))->toBeNull();
});

it('lets a seller view but not create products', function () {
    $user = User::factory()->create();
    $user->assignRole('seller');
    $this->actingAs($user);

    $this->get(route('admin.products.index'))->assertOk();
    $this->get(route('admin.products.create'))->assertForbidden();
});

it('404s when the product module is disabled', function () {
    actingAsAdmin();
    config(['admin.modules.product' => false]);

    $this->get(route('admin.products.index'))->assertNotFound();
});
