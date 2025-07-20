<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $clothes = Page::create([
            'name' => [
                'ro' => 'Despre noi',
                'ru' => 'О нас',
                'en' => 'About Us',
            ],
            'body' => [
                'ro' => 'Body RO!',
                'ru' => 'Body RU!',
                'en' => 'Body EN!',
            ],
            'page_meta' => [
                'meta_title' => [
                    'ro' => 'Title RO!',
                    'ru' => 'Title RU!',
                    'en' => 'Title EN!',
                ],
                'meta_description' => [
                    'ro' => 'Description RO!',
                    'ru' => 'Description RU!',
                    'en' => 'Description EN!',
                ],
                'meta_keywords' => [
                    'ro' => 'Keywords RO!',
                    'ru' => 'Keywords RU!',
                    'en' => 'Keywords EN!',
                ],
                'meta_robots' => [
                    'ro' => 'Index, Follow',
                    'ru' => 'Index, Follow',
                    'en' => 'Index, Follow',
                ],
                'meta_canonical' => [
                    'ro' => 'Canonical RO!',
                    'ru' => 'Canonical RU!',
                    'en' => 'Canonical EN!',
                ],
            ],
        ]);
    }
}
