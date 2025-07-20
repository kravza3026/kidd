<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'parent_id' => 1,
            'is_visible' => true,
            'name' => [
                'ro' => fake('ro_RO')->words(rand(2,3), true),
                'ru' => fake('ru_RU')->words(rand(2,3), true),
                'en' => fake('en_US')->words(rand(2,3), true),
            ],
            'description' => [
                'ro' => fake('ro_RO')->text(50),
                'ru' => fake('ru_RU')->text(50),
                'en' => fake('en_US')->text(50),
            ],
            'image' => fake()->imageUrl(1000, 1000, 'baby'),
        ];
    }

}
