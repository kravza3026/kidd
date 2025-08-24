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
            'company_id' => Company::factory(),
            'user_id' => User::factory(),
            'first_name' => $this->faker->locale('ro_RO')->firstName(),
            'last_name' => $this->faker->locale('ro_RO')->lastName(),
            'phone' => $this->faker->locale('ro_MD')->phoneNumber(),
            'email' => $this->faker->locale('ro_RO')->unique()->safeEmail(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
