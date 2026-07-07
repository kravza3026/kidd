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
     */
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 5);
        $unitPrice = $this->faker->numberBetween(5000, 50000); // minor units (MDL)

        return [
            'variant_snapshot' => ['sku' => $this->faker->bothify('??####'), 'name' => $this->faker->words(2, true)],
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $unitPrice * $quantity,

            'order_id' => Order::factory(),
            'product_variant_id' => ProductVariant::factory(),
        ];
    }
}
