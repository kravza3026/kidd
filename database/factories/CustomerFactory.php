<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::query()->inRandomOrder()->value('id') ?? Company::factory(),
            'user_id' => User::factory(),
            'first_name' => fake('ro_RO')->firstName(),
            'last_name' => fake('ro_RO')->lastName(),
            'phone' => fake()->unique()->numerify('+373########'),
            'email' => fake('ro_RO')->unique()->safeEmail(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
