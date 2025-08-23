<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'variant_snapshot' => $this->faker->words(),
            'quantity' => $this->faker->randomNumber(),
            'price' => $this->faker->randomNumber(),

            'order_id' => Order::factory(),
            'product_variant_id' => ProductVariant::factory(),
        ];
    }
}
