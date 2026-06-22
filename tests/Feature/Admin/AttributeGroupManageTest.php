<?php

use App\Livewire\Admin\Sizes;
use App\Models\AttributeGroup;
use App\Models\Size;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    app()->setLocale('en');
    actingAsAdmin();
});

it('assigns a group to an item from the form', function () {
    $group = AttributeGroup::factory()->forAttribute('size')->create();

    Livewire::test(Sizes\Form::class)
        ->set('name.ro', 'M')->set('name.ru', 'M')->set('name.en', 'M')
        ->set('attribute_group_id', $group->id)
        ->call('save')
        ->assertRedirect(route('admin.sizes.index'));

    expect(Size::query()->latest('id')->first()->attribute_group_id)->toBe($group->id);
});

it('adds, renames and deletes groups from the index', function () {
    $component = Livewire::test(Sizes\Index::class)->call('addGroup');

    $group = AttributeGroup::forAttribute('size')->first();
    expect($group)->not->toBeNull();

    $component->set("groupNames.{$group->id}.en", 'Clothing')->call('saveGroups');
    expect($group->fresh()->getTranslation('name', 'en'))->toBe('Clothing');

    $component->call('deleteGroup', $group->id);
    expect(AttributeGroup::find($group->id))->toBeNull();
});

it('does not create groups for an unrelated attribute', function () {
    Livewire::test(Sizes\Index::class)->call('addGroup');

    expect(AttributeGroup::where('attribute', 'size')->count())->toBe(1)
        ->and(AttributeGroup::where('attribute', 'color')->count())->toBe(0);
});

it('reorders an item into a group and sets its position', function () {
    $group = AttributeGroup::factory()->forAttribute('size')->create();
    $a = Size::factory()->create(['attribute_group_id' => $group->id, 'sort_order' => 0]);
    $b = Size::factory()->create(['attribute_group_id' => null]);

    Livewire::test(Sizes\Index::class)->call('reorderItem', $b->id, 0, $group->id);

    expect($b->fresh()->attribute_group_id)->toBe($group->id)
        ->and($b->fresh()->sort_order)->toBe(0)
        ->and($a->fresh()->sort_order)->toBe(1);
});

it('reorders groups by position', function () {
    $first = AttributeGroup::factory()->forAttribute('size')->create(['sort_order' => 0]);
    $second = AttributeGroup::factory()->forAttribute('size')->create(['sort_order' => 1]);

    Livewire::test(Sizes\Index::class)->call('reorderGroup', $second->id, 0);

    expect($second->fresh()->sort_order)->toBe(0)
        ->and($first->fresh()->sort_order)->toBe(1);
});
