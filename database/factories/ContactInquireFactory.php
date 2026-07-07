<?php

namespace Database\Factories;

use App\Models\ContactInquire;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactInquire>
 */
class ContactInquireFactory extends Factory
{
    protected $model = ContactInquire::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'first_name' => fake('ro_RO')->firstName(),
            'last_name' => fake('ro_RO')->lastName(),
            'phone' => fake()->numerify('+373########'),
            'email' => fake()->unique()->safeEmail(),
            'message' => fake()->paragraph(),
        ];
    }
}
