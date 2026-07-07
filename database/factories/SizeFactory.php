<?php

namespace Database\Factories;

use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Size>
 */
class SizeFactory extends Factory
{
    protected $model = Size::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement(['XS', 'S', 'M', 'L', 'XL', '92', '98', '104', '110']);
        $minAge = fake()->numberBetween(0, 120);

        // slug is generated from name by HasTranslatableSlug on save.
        return [
            'name' => ['ro' => $name, 'ru' => $name, 'en' => $name],
            'type' => Size::TYPE_CLOTH,
            'sort_order' => fake()->numberBetween(0, 50),
            'min_age' => $minAge,
            'max_age' => $minAge + 12,
            'min_height' => fake()->numberBetween(50, 150),
            'max_height' => fake()->numberBetween(151, 190),
            // Weights are stored in grams as smallint (max 32767).
            'min_weight' => fake()->numberBetween(3000, 15000),
            'max_weight' => fake()->numberBetween(15001, 32000),
        ];
    }
}
