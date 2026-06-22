<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    protected $model = Brand::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->company();

        // slug is generated from name by HasTranslatableSlug on save.
        return [
            'name' => ['ro' => $name, 'ru' => $name, 'en' => $name],
            'description' => ['ro' => fake()->sentence(), 'ru' => fake()->sentence(), 'en' => fake()->sentence()],
            'sort_order' => fake()->numberBetween(0, 50),
        ];
    }
}
