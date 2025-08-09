<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VacancyFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id' => 1,
            'location_id' => rand(1,2),

            'title' => [
                'ro' => $this->faker->jobTitle(),
                'ru' => $this->faker->jobTitle(),
                'en' => $this->faker->jobTitle(),
            ],
            'remote' => $this->faker->boolean(),
            'summary' => [
                'ro' => $this->faker->sentence(12),
                'ru' => $this->faker->sentence(12),
                'en' => $this->faker->sentence(12),
            ],
            'responsibilities' => [
                'ro' => $this->faker->paragraph(3),
                'ru' => $this->faker->paragraph(3),
                'en' => $this->faker->paragraph(3),
            ],
            'requirements' => [
                'ro' => $this->faker->paragraph(3),
                'ru' => $this->faker->paragraph(3),
                'en' => $this->faker->paragraph(3),
            ],
            'extra' => [
                'ro' => $this->faker->paragraph(2),
                'ru' => $this->faker->paragraph(2),
                'en' => $this->faker->paragraph(2),
            ],
            'notes' => $this->faker->optional()->paragraph(2),

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];
    }
}
