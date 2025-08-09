<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vacancy;
use Spatie\Tags\Tag;

class VacancySeeder extends Seeder
{
    public function run(): void
    {
        // Multilingual tags
        $tags = [
            [
                'name' => [
                    'ro' => 'Full-time',
                    'ru' => 'Полная занятость',
                    'en' => 'Full-time',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Part-time',
                    'ru' => 'Неполная занятость',
                    'en' => 'Part-time',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Remote',
                    'ru' => 'Удалённо',
                    'en' => 'Remote',
                ],
            ],
            [
                'name' => [
                    'ro' => 'On-Site',
                    'ru' => 'На месте',
                    'en' => 'On-Site',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Freelance',
                    'ru' => 'Фриланс',
                    'en' => 'Freelance',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Hybrid',
                    'ru' => 'Гибридный',
                    'en' => 'Hybrid',
                ],
            ],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }

        // Create vacancies with multilingual content
        Vacancy::factory(10)->create()->each(function ($vacancy) {
            $vacancy->syncTags(
                Tag::inRandomOrder()->take(rand(1, 3))->get()
            );
        });
    }
}
