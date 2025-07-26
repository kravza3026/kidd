<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_visible' => true,

            'category_id' => rand(2, 6), //Category::factory(),
            'brand_id' => 1,
            'gender_id' => rand(1, 3),
            'season_id' => rand(1, 5),
            'fabric_id' => rand(1, 5),

            'name' => [
                'ro' => '(ro) ' . fake('ro_RO')->sentence(rand(2, 3), false),
                'ru' => '(ru) ' . fake('ru_RU')->sentence(rand(2, 3), false),
                'en' => '(en) ' . fake('en_US')->sentence(rand(2, 3), false),
            ],
            'description' => [
                'ro' => '(ro) ' . fake('ro_RO')->paragraph(rand(2, 10)),
                'ru' => '(ru) ' . fake('ru_RU')->paragraph(rand(2, 10)),
                'en' => '(en) ' . fake('en_US')->paragraph(rand(2, 10)),
            ],

            'main_image' => 'products/product_'.rand(1, 9).'.png',

            'rating' => rand(1, 5),
            'review_count' => fake()->randomNumber(rand(2, 3)),

            'is_new' => rand(0, 1),
            'has_discount' => rand(0, 1),
            'is_featured' => rand(0, 1),
            'is_bestseller' => rand(0, 1),

            'barcode' => fake()->ean13(),
        ];
    }
}
