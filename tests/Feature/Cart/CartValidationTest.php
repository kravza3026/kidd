<?php

use LukePOLO\LaraCart\Facades\LaraCart;

it('adds a variant to the cart with a valid payload', function () {
    $variant = makeVariant();
    $variant->update(['quantity' => 10]);
    LaraCart::emptyCart();

    $this->postJson(route('api.cart.store'), ['variant_id' => $variant->id, 'quantity' => 2])
        ->assertOk();

    expect(LaraCart::count(false))->toBe(1);
});

it('rejects an add-to-cart payload missing required fields', function () {
    $this->postJson(route('api.cart.store'), [])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['variant_id', 'quantity']);
});

it('rejects a non-existent variant', function () {
    $this->postJson(route('api.cart.store'), ['variant_id' => 999999, 'quantity' => 1])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['variant_id']);
});

it('rejects a quantity beyond the available stock', function () {
    $variant = makeVariant();
    $variant->update(['quantity' => 3]);

    $this->postJson(route('api.cart.store'), ['variant_id' => $variant->id, 'quantity' => 5])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['quantity']);
});
