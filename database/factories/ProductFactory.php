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
            'is_visible' => rand(0, 1),

            'category_id' => rand(2, 6), //Category::factory(),
            'brand_id' => 1,
            'gender_id' => rand(1, 3),
            'season_id' => rand(1, 5),
            'fabric_id' => rand(1, 5),

            'name' => [
                'ro' => fake('ro_RO')->sentence(rand(3, 5), false),
                'ru' => fake('ru_RU')->sentence(rand(3, 5), false),
                'en' => fake('en_US')->sentence(rand(3, 5), false),
            ],
            'description' => [
                'ro' => fake('ro_RO')->paragraph(rand(2, 10)),
                'ru' => fake('ru_RU')->paragraph(rand(2, 10)),
                'en' => fake('en_US')->paragraph(rand(2, 10)),
            ],

            'main_image' => 'products/product_'.rand(1, 4).'.png',
//            'cost' => new Money(fake()->randomNumber(4), new \Money\Currency('MDL')),

            'rating' => rand(0, 6),
            'review_count' => fake()->randomNumber(rand(2, 3)),

            'is_new' => rand(0, 1),
            'has_discount' => rand(0, 1),
            'is_featured' => rand(0, 1),
            'is_bestseller' => rand(0, 1),

            'barcode' => fake()->ean13(),
        ];
    }
}
