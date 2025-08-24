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
     */
    public function definition(): array
    {
        return [
            'tracking_id' => $this->faker->randomNumber(1),
            'payment_id' => $this->faker->randomNumber(1),
            'order_number' => $this->faker->randomNumber(4),
            'total_amount' => $this->faker->randomNumber(5),
            'status' => 1, // Enum // 1 = Pending, 2 = Processing, 3 = Delivered, 4 = Canceled, 5 = Returned.
            'shipping_method' => 1, // Enum // 1 = Standard, 2 = Gift, 3 = Express
            'payment_method' => 1, // Enum // 1 = Cash on Delivery, 2 = Credit Card, 3 = Online Payment, 4 = Payment Terminal.
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
