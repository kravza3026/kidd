<?php

namespace Database\Factories;

use App\Models\AttributeGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AttributeGroup>
 */
class AttributeGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->word();

        return [
            'attribute' => 'size',
            'name' => ['ro' => $name, 'ru' => $name, 'en' => $name],
            'sort_order' => fake()->numberBetween(0, 20),
        ];
    }

    public function forAttribute(string $attribute): static
    {
        return $this->state(fn () => ['attribute' => $attribute]);
    }
}
