<?php

use App\Livewire\Admin\Audit\Index;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
});

it('records activity when an audited model changes', function () {
    $product = Product::factory()->create();

    expect(Activity::where('subject_type', Product::class)->where('event', 'created')->exists())->toBeTrue();

    $product->update(['is_visible' => false]);
    expect(Activity::where('subject_id', $product->id)->where('event', 'updated')->exists())->toBeTrue();
});

it('lists activity for an admin', function () {
    actingAsAdmin();
    Category::factory()->create();

    $this->get(route('admin.audit.index'))->assertOk()->assertSeeLivewire(Index::class);
    Livewire::test(Index::class)->assertSee('Category')->assertSee('Created');
});

it('filters the audit log by event', function () {
    actingAsAdmin();
    $product = Product::factory()->create();
    $product->update(['is_new' => ! $product->is_new]);

    Livewire::test(Index::class)
        ->set('event', 'updated')
        ->assertSee('Updated');
});

it('forbids a manager from the audit log', function () {
    $manager = User::factory()->create();
    $manager->assignRole('manager');
    $this->actingAs($manager);

    $this->get(route('admin.audit.index'))->assertForbidden();
});
