<?php

namespace Database\Factories;

use App\Models\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gender>
 */
class GenderFactory extends Factory
{
    protected $model = Gender::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement(['Unisex', 'Boy', 'Girl', 'Men', 'Women']);

        return [
            'name' => ['ro' => $name, 'ru' => $name, 'en' => $name],
            'code' => strtoupper(substr($name, 0, 1)),
            'bg_color' => fake()->hexColor(),
            'sort_order' => fake()->numberBetween(0, 50),
        ];
    }
}
