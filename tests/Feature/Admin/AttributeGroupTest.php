<?php

use App\Models\AttributeGroup;
use App\Models\Color;
use App\Models\Size;

it('assigns a taxonomy item to an editable group', function () {
    $group = AttributeGroup::create([
        'attribute' => 'size',
        'name' => ['ro' => 'Haine', 'ru' => 'Одежда', 'en' => 'Clothing'],
        'sort_order' => 1,
    ]);
    $size = Size::factory()->create(['attribute_group_id' => $group->id]);

    expect($size->group->is($group))->toBeTrue()
        ->and($size->group->getTranslation('name', 'en'))->toBe('Clothing');
});

it('scopes groups to their attribute, ordered by sort_order', function () {
    AttributeGroup::factory()->forAttribute('color')->create(['sort_order' => 2, 'name' => ['en' => 'B']]);
    AttributeGroup::factory()->forAttribute('color')->create(['sort_order' => 1, 'name' => ['en' => 'A']]);
    AttributeGroup::factory()->forAttribute('size')->create(['name' => ['en' => 'Other']]);

    $colors = AttributeGroup::forAttribute('color')->get();

    expect($colors)->toHaveCount(2)
        ->and($colors->first()->getTranslation('name', 'en'))->toBe('A');
});

it('nulls the item group when the group is deleted', function () {
    $group = AttributeGroup::factory()->forAttribute('color')->create();
    $color = Color::factory()->create(['attribute_group_id' => $group->id]);

    $group->delete();

    expect($color->fresh()->attribute_group_id)->toBeNull();
});
