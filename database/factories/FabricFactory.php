<?php

namespace Database\Factories;

use App\Models\Fabric;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Fabric>
 */
class FabricFactory extends Factory
{
    protected $model = Fabric::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement(['Cotton', 'Wool', 'Linen', 'Polyester', 'Denim', 'Silk']);

        return [
            'name' => ['ro' => $name, 'ru' => $name, 'en' => $name],
            'sort_order' => fake()->numberBetween(0, 50),
        ];
    }
}
