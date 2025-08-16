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
                'ro' => fake('ro_RO')->word(),
                'ru' => fake('ru_RU')->word(),
                'en' => fake('en_US')->word(),
            ],
            'slug' => [
                'ro' => fake('ro_RO')->slug(),
                'ru' => fake('ru_RU')->slug(),
                'en' => fake('en_US')->slug(),
            ],
            'type' => null,
        ];
    }
}
