<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company().' SRL',
            'idno' => (string) fake()->numerify('##########'),
            'email' => fake()->companyEmail(),
            'phone' => fake()->e164PhoneNumber(),
            'website' => fake()->url(),
            'tva' => 20,
            'status' => 1,
        ];
    }
}
