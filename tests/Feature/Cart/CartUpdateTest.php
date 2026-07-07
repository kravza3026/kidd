<?php

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use LukePOLO\LaraCart\Facades\LaraCart;

/**
 * Two variants of the same product, plus a cart holding variant A at qty 2.
 *
 * @return array{0: ProductVariant, 1: ProductVariant, 2: string}
 */
function cartWithVariant(): array
{
    $product = Product::factory()->create();
    $variantA = ProductVariant::factory()->for($product)->create([
        'color_id' => Color::factory(), 'size_id' => Size::factory(), 'quantity' => 10,
    ]);
    $variantB = ProductVariant::factory()->for($product)->create([
        'color_id' => Color::factory(), 'size_id' => Size::factory(), 'quantity' => 10,
    ]);

    LaraCart::emptyCart();
    LaraCart::add(
        itemID: $product,
        price: 5000,
        qty: 2,
        options: ['variant' => $variantA, 'color' => $variantA->color, 'size' => $variantA->size, 'price' => 5000],
    );

    return [$variantA, $variantB, array_key_first(LaraCart::getItems())];
}

it('updates the cart item quantity', function () {
    [$variantA, , $hash] = cartWithVariant();

    $this->putJson(route('api.cart.update', $hash), ['variant_id' => $variantA->id, 'quantity' => 5])
        ->assertOk();

    $item = collect(LaraCart::getItems())->first();
    expect($item->qty)->toBe(5);
});

it('updates the cart item to a different variant (size/color change)', function () {
    [, $variantB, $hash] = cartWithVariant();

    $this->putJson(route('api.cart.update', $hash), ['variant_id' => $variantB->id, 'quantity' => 3])
        ->assertOk();

    $item = collect(LaraCart::getItems())->first();
    expect($item->qty)->toBe(3)
        ->and($item->options['variant']->id)->toBe($variantB->id)
        ->and($item->options['color']->id)->toBe($variantB->color_id)
        ->and($item->options['size']->id)->toBe($variantB->size_id);
});
