<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Money\Currency;
use Money\Money;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),

            'is_visible' => rand(0, 1), // Variant is available

            'color_id' => rand(1, 8),
            'size_id' => rand(1, 8),

            'sku' => fake()->unique()->regexify('[A-Z]{2}[0-9]{4}'), // Stock Keeping Unit

            'quantity' => rand(1, 100), // Quantity

            'price_vendor' => new Money(fake()->randomNumber(4), new Currency('MDL')), //Buy price
            'price_wholesale' => new Money(fake()->randomNumber(5), new Currency('MDL')), // Wholesale Sales price
            'price_online' => new Money(fake()->randomNumber(6), new Currency('MDL')), // Online Store Sales price
            'price_store' => new Money(fake()->randomNumber(6), new Currency('MDL')), // Physical Store Sales price

            'price_final' => new Money(fake()->randomNumber(5), new Currency('MDL')), // Final cost after discount (online price - discount amount) (old price - price_online, new price - price_final)
            'discount_amount' => rand(1, 1000), // Discount amount
            'discount_display' => rand(10, 30), // Discount display

            'price_shipping' => new Money(fake()->randomNumber(4), new Currency('MDL')), // Shipping cost

            'images' => json_encode([
                'image_1' => 'product-'.rand(1, 9).'.png',
                'image_2' => 'product-'.rand(1, 9).'.png',
                'image_3' => 'product-'.rand(1, 9).'.png',
                'image_4' => 'product-'.rand(1, 9).'.png',
                'image_5' => 'product-'.rand(1, 9).'.png',
            ]), // Images
            'videos' => json_encode([
                'video_1' => 'product-'.rand(1, 9).'.mp4',
                'video_2' => 'product-'.rand(1, 9).'.mp4',
                'video_3' => 'product-'.rand(1, 9).'.mp4',
                'video_4' => 'product-'.rand(1, 9).'.mp4',
                'video_5' => 'product-'.rand(1, 9).'.mp4',
            ]), // Videos

            'shipping_sizes' => json_encode([
                'shipping_weight' => rand(100, 1000),
                'shipping_height' => rand(100, 1000),
                'shipping_width' => rand(100, 1000),
                'shipping_length' => rand(100, 1000),
            ]),


        ];
    }
}
