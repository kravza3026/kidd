<?php

namespace Database\Factories;

use App\Enums\ReturnReason;
use App\Enums\ReturnStatus;
use App\Models\Order;
use App\Models\OrderReturn;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderReturn>
 */
class OrderReturnFactory extends Factory
{
    protected $model = OrderReturn::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'customer_id' => null,
            'reason' => $this->faker->randomElement(ReturnReason::cases()),
            'status' => ReturnStatus::Pending,
            'item_ids' => [],
            'comment' => $this->faker->optional()->sentence(),
        ];
    }
}
