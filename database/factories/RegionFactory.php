<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Region>
 */
class RegionFactory extends Factory
{
    protected $model = Region::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = ucfirst(fake()->unique()->word());

        return [
            'country_id' => Country::query()->inRandomOrder()->value('id') ?? Country::factory(),
            'name' => ['ro' => $name, 'ru' => $name, 'en' => $name],
            'code' => strtoupper(fake()->unique()->lexify('??')),
            'sort_order' => fake()->numberBetween(1, 50),
        ];
    }
}
