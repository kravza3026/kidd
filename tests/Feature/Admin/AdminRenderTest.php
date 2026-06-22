<?php

use App\Livewire\Admin\Categories\Form;
use App\Models\Category;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    actingAsAdmin();
});

it('renders the dashboard with stat cards', function () {
    $this->get(route('admin.home'))
        ->assertOk()
        ->assertSee('Dashboard')
        ->assertSee('Products');
});

it('renders the command palette with discovered destinations', function () {
    $this->get(route('admin.home'))
        ->assertOk()
        ->assertSee('Jump to…')
        ->assertSee('admin-palette', false)   // ⌘K dispatch wiring
        ->assertSee('Categories');            // a discovered destination in the palette JSON
});

it('renders the category create form (Livewire)', function () {
    $this->get(route('admin.categories.create'))
        ->assertOk()
        ->assertSeeLivewire(Form::class)
        ->assertSee('wire:model="name.ro"', false)
        ->assertSee('Visible on storefront');
});

it('renders the category edit form prefilled (Livewire)', function () {
    $category = Category::factory()->create();

    $this->get(route('admin.categories.edit', $category))
        ->assertOk()
        ->assertSeeLivewire(Form::class);
});
