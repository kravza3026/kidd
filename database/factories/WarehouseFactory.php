<?php

namespace Database\Factories;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Warehouse>
 */
class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->city().' '.fake()->randomElement(['Depot', 'Warehouse', 'Hub']);

        return [
            'name' => ['ro' => $name, 'ru' => $name, 'en' => $name],
            'code' => strtoupper(fake()->unique()->lexify('???')),
        ];
    }
}
