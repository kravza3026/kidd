<?php

namespace Database\Factories;

use App\Models\CareInstruction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CareInstruction>
 */
class CareInstructionFactory extends Factory
{
    protected $model = CareInstruction::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->randomElement([
            'Machine wash', 'Do not bleach', 'Tumble dry', 'Iron low', 'Dry clean only', 'Hand wash',
        ]);

        return [
            'name' => $title,
            'title' => ['ro' => $title, 'ru' => $title, 'en' => $title],
            'description' => ['ro' => fake()->sentence(), 'ru' => fake()->sentence(), 'en' => fake()->sentence()],
            'icon' => null,
            'sort_order' => fake()->numberBetween(0, 50),
        ];
    }
}
