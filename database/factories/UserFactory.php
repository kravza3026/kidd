<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Reuse a seeded company when present, otherwise stand one up so factory-only
            // tests satisfy the required company_id foreign key.
            'company_id' => Company::query()->value('id') ?? Company::factory(),
            'first_name' => fake(fake()->randomElement(['ro_RO', 'ru_RU', 'en_EN']))->firstName(),
            'last_name' => fake(fake()->randomElement(['ro_RO', 'ru_RU', 'en_EN']))->lastName(),
            // Valid Moldovan mobile number (the app's E164 cast + phone rules target MD).
            'phone' => '+37360'.fake()->unique()->numerify('######'),
            'phone_verified_at' => now(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'newsletter' => true,
            'new_order_to_email' => true,
            'new_order_to_sms' => true,
            'order_status_email' => true,
            'order_status_sms' => true,
            'email_marketing' => true,
            'sms_marketing' => true,
            'default_locale' => fake()->randomElement(['ro', 'ru', 'en']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
            'phone_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function emailUnverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function phoneUnverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'phone_verified_at' => null,
        ]);
    }
}
