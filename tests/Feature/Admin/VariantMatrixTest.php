<?php

use App\Livewire\Admin\Products\Variants;
use App\Models\Color;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\User;
use App\Support\Barcode;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Illuminate\Database\UniqueConstraintViolationException;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    app()->setLocale('en');
});

it('generates the cartesian matrix with unique SKUs and barcodes', function () {
    actingAsAdmin();
    $product = Product::factory()->create();
    [$c1, $c2] = Color::factory()->count(2)->create();
    [$s1, $s2] = Size::factory()->count(2)->create();

    $component = Livewire::test(Variants::class, ['product' => $product])
        ->set('selectedColors', [$c1->id, $c2->id])
        ->set('selectedSizes', [$s1->id, $s2->id])
        ->call('generate');

    $rows = $component->get('rows');
    expect($rows)->toHaveCount(4)
        ->and(collect($rows)->pluck('sku')->unique())->toHaveCount(4)
        ->and(collect($rows)->pluck('barcode')->unique())->toHaveCount(4)
        ->and(collect($rows)->every(fn ($r) => Barcode::isValidEan13($r['barcode'])))->toBeTrue();
});

it('does not duplicate combos when regenerated', function () {
    actingAsAdmin();
    $product = Product::factory()->create();
    $color = Color::factory()->create();
    [$s1, $s2] = Size::factory()->count(2)->create();

    $component = Livewire::test(Variants::class, ['product' => $product])
        ->set('selectedColors', [$color->id])
        ->set('selectedSizes', [$s1->id, $s2->id])
        ->call('generate')
        ->call('generate');

    expect($component->get('rows'))->toHaveCount(2);
});

it('bulk fills price and quantity across all rows', function () {
    actingAsAdmin();
    $product = Product::factory()->create();
    $color = Color::factory()->create();
    [$s1, $s2] = Size::factory()->count(2)->create();

    $component = Livewire::test(Variants::class, ['product' => $product])
        ->set('selectedColors', [$color->id])
        ->set('selectedSizes', [$s1->id, $s2->id])
        ->call('generate')
        ->set('bulkPriceOnline', 250.00)
        ->set('bulkQuantity', 12)
        ->call('applyBulk');

    expect(collect($component->get('rows'))->every(fn ($r) => $r['price_online'] === 250.00 && $r['quantity'] === 12))->toBeTrue();
});

it('persists generated variants with money stored in minor units', function () {
    actingAsAdmin();
    $product = Product::factory()->create();
    $color = Color::factory()->create();
    $size = Size::factory()->create();

    Livewire::test(Variants::class, ['product' => $product])
        ->set('selectedColors', [$color->id])
        ->set('selectedSizes', [$size->id])
        ->call('generate')
        ->set('rows.0.price_online', 199.99)
        ->set('rows.0.price_final', 149.99)
        ->set('rows.0.quantity', 7)
        ->call('save')
        ->assertRedirect(route('admin.products.show', $product->id));

    $variant = $product->variants()->sole();
    expect($variant->color_id)->toBe($color->id)
        ->and($variant->size_id)->toBe($size->id)
        ->and($variant->quantity)->toBe(7)
        ->and($variant->price_online)->toBe(19999)
        ->and($variant->price_final)->toBe(14999)
        ->and($variant->sku)->not->toBeEmpty()
        ->and(Barcode::isValidEan13($variant->barcode))->toBeTrue();
});

it('enforces the unique colour+size combo at the database level', function () {
    $product = Product::factory()->create();
    $color = Color::factory()->create();
    $size = Size::factory()->create();

    ProductVariant::factory()->for($product)->create(['color_id' => $color->id, 'size_id' => $size->id]);

    expect(fn () => ProductVariant::factory()->for($product)->create(['color_id' => $color->id, 'size_id' => $size->id]))
        ->toThrow(UniqueConstraintViolationException::class);
});

it('hard-deletes a removed variant that was never ordered', function () {
    actingAsAdmin();
    $product = Product::factory()->create();
    $variant = ProductVariant::factory()->for($product)->create([
        'color_id' => Color::factory()->create()->id,
        'size_id' => Size::factory()->create()->id,
    ]);

    Livewire::test(Variants::class, ['product' => $product])
        ->call('removeRow', 0)
        ->call('save');

    expect(ProductVariant::find($variant->id))->toBeNull();
});

it('hides rather than deletes a removed variant that has been ordered', function () {
    actingAsAdmin();
    $product = Product::factory()->create();
    $variant = ProductVariant::factory()->for($product)->create([
        'is_visible' => true,
        'color_id' => Color::factory()->create()->id,
        'size_id' => Size::factory()->create()->id,
    ]);
    OrderItem::factory()->create(['product_variant_id' => $variant->id]);

    Livewire::test(Variants::class, ['product' => $product])
        ->call('removeRow', 0)
        ->call('save');

    expect($variant->fresh())->not->toBeNull()
        ->and($variant->fresh()->is_visible)->toBeFalse();
});

it('forbids a seller without product update permission', function () {
    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);
    $product = Product::factory()->create();

    $this->get(route('admin.products.variants', $product->id))->assertForbidden();
});
