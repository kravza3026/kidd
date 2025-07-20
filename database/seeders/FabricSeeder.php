<?php

namespace Database\Seeders;

use App\Models\Fabric;
use Illuminate\Database\Seeder;

class FabricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fabric::create([
            'name' => [
                'ro' => 'Bumbac',
                'ru' => 'Хлопок',
                'en' => 'Cotton',
            ],
            'image_path' => 'cotton.png',
            'image_encoded' => null,
        ]);

        Fabric::create([
            'name' => [
                'ro' => 'Lână',
                'ru' => 'Флис',
                'en' => 'Fleece',
            ],
            'image_path' => 'fleece.png',
            'image_encoded' => null,
        ]);

        Fabric::create([
            'name' => [
                'ro' => 'Voile',
                'ru' => 'Вуаль',
                'en' => 'Voile',
            ],
            'image_path' => 'voile.png',
            'image_encoded' => null,
        ]);

        Fabric::create([
            'name' => [
                'ro' => 'In',
                'ru' => 'Лён',
                'en' => 'Linen',
            ],
            'image_path' => 'linen.png',
            'image_encoded' => null,
        ]);

        Fabric::create([
            'name' => [
                'ro' => 'Lână (Organică)',
                'ru' => 'Шерсть',
                'en' => 'Wool',
            ],
            'image_path' => 'wool.png',
            'image_encoded' => null,
        ]);
    }
}
