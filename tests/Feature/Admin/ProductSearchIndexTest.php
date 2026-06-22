<?php

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Money\Currency;

it('indexes only text columns for the database engine', function () {
    config(['scout.driver' => 'database']);
    $product = Product::factory()->create();

    expect(array_keys($product->toSearchableArray()))->toBe(['id', 'name']);
});

it('indexes a faceted document for meilisearch', function () {
    // Build with the default (database) engine — no external indexing — then evaluate the
    // document as the meilisearch engine would request it.
    $product = Product::factory()->create();
    $color = Color::factory()->create();
    $size = Size::factory()->create();
    ProductVariant::factory()->for($product)->create([
        'color_id' => $color->id,
        'size_id' => $size->id,
        'price_final' => new Money\Money(4999, new Currency('MDL')),
    ]);

    config(['scout.driver' => 'meilisearch']);
    $document = $product->fresh()->toSearchableArray();

    expect($document)->toHaveKeys([
        'category_id', 'gender_id', 'brand_id', 'season_id', 'fabric_id',
        'color_ids', 'size_ids', 'min_price', 'is_visible', 'is_new',
        'has_discount', 'is_featured', 'is_bestseller', 'created_at',
    ])
        ->and($document['color_ids'])->toContain($color->id)
        ->and($document['size_ids'])->toContain($size->id)
        ->and($document['min_price'])->toBe(4999);
});

it('declares product facets as filterable and sortable in scout config', function () {
    $settings = config('scout.meilisearch.index-settings.products_index');

    expect($settings['filterableAttributes'])->toContain('category_id', 'color_ids', 'min_price')
        ->and($settings['sortableAttributes'])->toContain('min_price', 'created_at');
});
