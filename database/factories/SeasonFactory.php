<?php

namespace Database\Factories;

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Season>
 */
class SeasonFactory extends Factory
{
    protected $model = Season::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement(['Spring', 'Summer', 'Autumn', 'Winter', 'All season']);

        return [
            'name' => ['ro' => $name, 'ru' => $name, 'en' => $name],
            'sort_order' => fake()->numberBetween(0, 50),
        ];
    }
}
