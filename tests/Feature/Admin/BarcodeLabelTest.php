<?php

use App\Livewire\Admin\Products\Labels;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\User;
use App\Support\Barcode;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    app()->setLocale('en');
});

it('renders a valid EAN-13 as an SVG and rejects invalid input', function () {
    $valid = Barcode::randomEan13();

    expect(Barcode::svg($valid))->toContain('<svg')
        ->and(Barcode::svg('123'))->toBeNull()
        ->and(Barcode::svg('not-a-barcode'))->toBeNull();
});

it('renders the label sheet with a barcode for each variant', function () {
    actingAsAdmin();
    $variant = makeVariant();
    $variant->forceFill(['sku' => 'LB1234', 'barcode' => Barcode::randomEan13()])->save();

    $this->get(route('admin.products.labels', $variant->product_id))
        ->assertOk()
        ->assertSeeLivewire(Labels::class);

    Livewire::test(Labels::class, ['product' => $variant->product])
        ->assertSee('LB1234')
        ->assertSee('<svg', false);
});

it('skips variants without a printable barcode', function () {
    actingAsAdmin();
    $product = Product::factory()->create();
    ProductVariant::factory()->for($product)->create([
        'color_id' => Color::factory()->create()->id,
        'size_id' => Size::factory()->create()->id,
        'barcode' => null,
    ]);

    Livewire::test(Labels::class, ['product' => $product])
        ->assertSee('No printable barcodes');
});

it('forbids a seller from printing labels', function () {
    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);
    $variant = makeVariant();

    $this->get(route('admin.products.labels', $variant->product_id))->assertForbidden();
});
