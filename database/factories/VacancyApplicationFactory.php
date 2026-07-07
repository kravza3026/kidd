<?php

namespace Database\Factories;

use App\Models\Vacancy;
use App\Models\VacancyApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VacancyApplication>
 */
class VacancyApplicationFactory extends Factory
{
    protected $model = VacancyApplication::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vacancy_id' => Vacancy::query()->inRandomOrder()->value('id') ?? Vacancy::factory(),
            'user_id' => null,
            'first_name' => fake('ro_RO')->firstName(),
            'last_name' => fake('ro_RO')->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => '+373'.fake()->numerify('########'),
            'cv_file_path' => null,
            'cv_url' => fake()->optional()->url(),
        ];
    }
}
