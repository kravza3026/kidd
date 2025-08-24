<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'company_id' => 1,
            'location_id' => rand(1, 2),

            'title' => [
                'ro' => fake('ro_RO')->jobTitle(),
                'ru' => fake('ru_RU')->jobTitle(),
                'en' => fake('en_US')->jobTitle(),
            ],
            'remote' => fake()->boolean(),
            'summary' => [
                'ro' => fake('ro_RO')->sentence(12),
                'ru' => fake('ru_RU')->sentence(12),
                'en' => fake('en_US')->sentence(12),
            ],
            'responsibilities' => [
                'ro' => fake('ro_RO')->paragraph(3),
                'ru' => fake('ru_RU')->paragraph(3),
                'en' => fake('en_US')->paragraph(3),
            ],
            'requirements' => [
                'ro' => fake('ro_RO')->paragraph(3),
                'ru' => fake('ru_RU')->paragraph(3),
                'en' => fake('en_US')->paragraph(3),
            ],
            'extra' => [
                'ro' => fake('ro_RO')->paragraph(2),
                'ru' => fake('ru_RU')->paragraph(2),
                'en' => fake('en_US')->paragraph(2),
            ],
            'notes' => $this->faker->optional()->paragraph(2),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];
    }
}
