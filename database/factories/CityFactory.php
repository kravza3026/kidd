<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<City>
 */
class CityFactory extends Factory
{
    protected $model = City::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->city();

        return [
            'region_id' => Region::query()->inRandomOrder()->value('id') ?? Region::factory(),
            'name' => ['ro' => $name, 'ru' => $name, 'en' => $name],
            'sort_order' => fake()->numberBetween(1, 50),
        ];
    }
}
