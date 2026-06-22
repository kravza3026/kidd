<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Color>
 */
class ColorFactory extends Factory
{
    protected $model = Color::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->colorName();

        // slug is generated from name by HasTranslatableSlug on save.
        return [
            'name' => ['ro' => $name, 'ru' => $name, 'en' => $name],
            'hex' => fake()->hexColor(),
            'type' => 1,
            'sort_order' => fake()->numberBetween(0, 50),
        ];
    }
}
