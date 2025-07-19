<?php

namespace Database\Seeders;

use App\Models\Season;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Season::create([
            'name' => [
                'ro' => 'Universal',
                'ru' => 'Все сезонно',
                'en' => 'Universal',
            ],
        ]);
        Season::create([
            'name' => [
                'ro' => 'Iarna',
                'ru' => 'Зима',
                'en' => 'Winter',
            ],
        ]);
        Season::create([
            'name' => [
                'ro' => 'Primăvara',
                'ru' => 'Весна',
                'en' => 'Spring',
            ],
        ]);
        Season::create([
            'name' => [
                'ro' => 'Vara',
                'ru' => 'Лето',
                'en' => 'Summer',
            ],
        ]);
        Season::create([
            'name' => [
                'ro' => 'Toamna',
                'ru' => 'Осень',
                'en' => 'Autumn',
            ],
        ]);
    }
}
