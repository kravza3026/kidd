<?php

use App\Models\Brand;
use App\Models\CareInstruction;
use App\Models\Color;
use App\Models\Company;
use App\Models\Fabric;
use App\Models\Gender;
use App\Models\Season;
use App\Models\Size;

it('builds every taxonomy model via its factory', function (string $model) {
    $instance = $model::factory()->create();

    expect($instance->exists)->toBeTrue();
})->with([
    Brand::class,
    Gender::class,
    Season::class,
    Fabric::class,
    Color::class,
    Size::class,
    CareInstruction::class,
    Company::class,
]);

it('persists translatable names and auto-generates slugs', function () {
    $brand = Brand::factory()->create();

    expect($brand->getTranslations('name'))->toHaveKeys(['ro', 'ru', 'en'])
        ->and($brand->getTranslation('slug', 'en'))->not->toBeEmpty();

    $color = Color::factory()->create();
    expect($color->getTranslation('slug', 'ro'))->not->toBeEmpty();
});
