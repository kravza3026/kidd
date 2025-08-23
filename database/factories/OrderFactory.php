<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'tracking_id' => $this->faker->randomNumber(),
            'payment_id' => $this->faker->randomNumber(),
            'order_number' => $this->faker->randomNumber(),
            'total_amount' => $this->faker->randomNumber(),
            'status' => $this->faker->word(),
            'shipping_address' => $this->faker->address(),
            'billing_address' => $this->faker->address(),
            'cart_snapshot' => $this->faker->words(),
            'notes' => $this->faker->word(),
            'placed_at' => Carbon::now(),
            'processed_at' => Carbon::now(),
            'delivered_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'customer_id' => Customer::factory(),
        ];
    }
}
