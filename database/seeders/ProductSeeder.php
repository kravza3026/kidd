<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Product::factory()
            ->has(ProductVariant::factory()->count(5), 'variants')
            ->count(300)
            ->afterCreating(function (Product $product) {
                $product
                    ->addMedia(resource_path('/images/products/product_'.rand(1, 9).'.webp'))
                    ->preservingOriginal()
                    ->toMediaCollection('gallery');
            })
            ->create();
    }
}
