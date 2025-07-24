<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Color::create([
            'name' => [
                'ro' => 'Cafeniu',
                'ru' => 'Коричневый',
                'en' => 'Tan',
            ],
            'slug' => [
                'ro' => 'cafeniu',
                'ru' => 'korichnevyy',
                'en' => 'tan',
            ],
            'hex' => '#C9B599',
            'icon' => null,
        ]);

        Color::create([
            'name' => [
                'ro' => 'Roz',
                'ru' => 'Розовый',
                'en' => 'Pink',
            ],
            'slug' => [
                'ro' => 'roz',
                'ru' => 'rozovyy',
                'en' => 'pink',
            ],
            'hex' => '#F8CACA',
            'icon' => null,
        ]);

        Color::create([
            'name' => [
                'ro' => 'Albastru',
                'ru' => 'Синий',
                'en' => 'Blue',
            ],
            'slug' => [
                'ro' => 'albastru',
                'ru' => 'siniy',
                'en' => 'blue',
            ],
            'hex' => '#C1E5F0',
            'icon' => null,
        ]);

        Color::create([
            'name' => [
                'ro' => 'Alb',
                'ru' => 'Белый',
                'en' => 'White',
            ],
            'slug' => [
                'ro' => 'alb',
                'ru' => 'belyy',
                'en' => 'white',
            ],
            'hex' => '#FFFFFF',
            'icon' => null,
        ]);

        Color::create([
            'name' => [
                'ro' => 'Turcoaz',
                'ru' => 'Бирюзовый',
                'en' => 'Turquoise',
            ],
            'slug' => [
                'ro' => 'turcoaz',
                'ru' => 'biryuzovyy',
                'en' => 'turquoise',
            ],
            'hex' => '#0AFFF0',
            'icon' => null,
        ]);

        Color::create([
            'name' => [
                'ro' => 'Roșu',
                'ru' => 'Красный',
                'en' => 'Red',
            ],
            'slug' => [
                'ro' => 'red',
                'ru' => 'krasnyy',
                'en' => 'red',
            ],
            'hex' => '#F95757',
            'icon' => null,
        ]);

        Color::create([
            'name' => [
                'ro' => 'Galben',
                'ru' => 'Жёлтый',
                'en' => 'Yellow',
            ],
            'slug' => [
                'ro' => 'galben',
                'ru' => 'zheltyy',
                'en' => 'yellow',
            ],
            'hex' => 'yellow',
            'icon' => null,
        ]);

        Color::create([
            'name' => [
                'ro' => 'Negru',
                'ru' => 'Черный',
                'en' => 'Black',
            ],
            'slug' => [
                'ro' => 'negru',
                'ru' => 'chernyy',
                'en' => 'black',
            ],
            'hex' => '#000000',
            'icon' => null,
        ]);
    }
}
