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
            'hex' => '#C9B599',
            'icon' => null,
        ]);

        Color::create([
            'name' => [
                'ro' => 'Roz',
                'ru' => 'Розовый',
                'en' => 'Pink',
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
            'hex' => '#C1E5F0',
            'icon' => null,
        ]);

        Color::create([
            'name' => [
                'ro' => 'Alb',
                'ru' => 'Белый',
                'en' => 'White',
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
            'hex' => '#0AFFF0',
            'icon' => null,
        ]);

        Color::create([
            'name' => [
                'ro' => 'Roșu',
                'ru' => 'Красный',
                'en' => 'Red',
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
            'hex' => 'yellow',
            'icon' => null,
        ]);

        Color::create([
            'name' => [
                'ro' => 'Negru',
                'ru' => 'Черный',
                'en' => 'Black',
            ],
            'hex' => '#000000',
            'icon' => null,
        ]);
    }
}
