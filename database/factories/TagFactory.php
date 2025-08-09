<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        return [
            'name' => [
                'ro' => $this->faker->word(),
                'ru' => $this->faker->word(),
                'en' => $this->faker->word(),
            ],
            'slug' => [
                'ro' => $this->faker->slug(),
                'ru' => $this->faker->slug(),
                'en' => $this->faker->slug(),
            ],
            'type' => null,
        ];
    }
}
