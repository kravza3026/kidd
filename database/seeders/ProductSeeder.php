<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Five distinct colour × size combos per product so the unique
        // (product_id, color_id, size_id) index holds on migrate:fresh --seed.
        $combos = new Sequence(
            ['color_id' => 1, 'size_id' => 1],
            ['color_id' => 2, 'size_id' => 2],
            ['color_id' => 3, 'size_id' => 3],
            ['color_id' => 4, 'size_id' => 4],
            ['color_id' => 5, 'size_id' => 5],
        );

        Product::factory()
            ->has(ProductVariant::factory()->count(5)->state($combos), 'variants')
            ->count(123)
            ->afterCreating(function (Product $product) {

                foreach (range(1, rand(2, 5)) as $care_id) {
                    $instructions_ids[] = rand(1, 20);
                }

                $product->careInstructions()->sync($instructions_ids);

                foreach (range(1, rand(2, 5)) as $index) {
                    $product
                        ->addMedia(resource_path('/images/products/product_'.rand(1, 9).'.webp'))
                        ->preservingOriginal()
                        ->toMediaCollection('gallery');
                }

            })
            ->create();
    }
}
