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

            'quantity' => rand(10, 100), // Quantity

            'price_vendor' => $vendor_price = new Money(rand(1000, 100000), new Currency('MDL')), //Buy price (in cents)
            'price_wholesale' => $wholesale_price = new Money((int) ($vendor_price->getAmount() * 1.3), new Currency('MDL')), // Wholesale Sales price = vendor + 30%
            'price_online' => $online_price = new Money((int) ($wholesale_price->getAmount() * 1.4), new Currency('MDL')), // Online price = wholesale + 40%
            'price_store' => new Money((int) ($wholesale_price->getAmount() * 1.5), new Currency('MDL')), // Store price = wholesale + 50%

            'discount_display' => $discount_percent = rand(10, 30), // Discount percentage between 10-30%
            'discount_amount' => $discount = (int) ($online_price->getAmount() * ($discount_percent / 100)), // Calculate actual discount amount

            'price_final' => new Money($online_price->getAmount() - $discount, new Currency('MDL')), // Final price after discount

            'price_shipping' => new Money(5000, new Currency('MDL')), // Fixed shipping cost of 50 MDL

            'images' => json_encode([
                'image_1' => 'products/product_'.rand(1, 9).'.png',
                'image_2' => 'products/product_'.rand(1, 9).'.png',
                'image_3' => 'products/product_'.rand(1, 9).'.png',
                'image_4' => 'products/product_'.rand(1, 9).'.png',
                'image_5' => 'products/product_'.rand(1, 9).'.png',
            ]), // Images
            'videos' => json_encode([
                'video_1' => 'products/product_'.rand(1, 9).'.mp4',
                'video_2' => 'products/product_'.rand(1, 9).'.mp4',
                'video_3' => 'products/product_'.rand(1, 9).'.mp4',
                'video_4' => 'products/product_'.rand(1, 9).'.mp4',
                'video_5' => 'products/product_'.rand(1, 9).'.mp4',
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
