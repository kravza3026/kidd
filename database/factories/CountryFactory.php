<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Country>
 */
class CountryFactory extends Factory
{
    protected $model = Country::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->country();

        return [
            'name' => ['ro' => $name, 'ru' => $name, 'en' => $name],
            'iso_alpha2' => strtoupper(fake()->unique()->lexify('??')),
            'currency_code' => 'MDL',
        ];
    }
}
