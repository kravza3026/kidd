<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            [
                'name' => [
                    'ro' => 'mun. Chișinău',
                    'ru' => 'мун. Кишинёв',
                    'en' => 'mun. Chisinau',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Anenii Noi',
                    'ru' => 'Anenii Noi',
                    'en' => 'Anenii Noi',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Bălţi',
                    'ru' => 'Bălţi',
                    'en' => 'Bălţi',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Basarabeasca',
                    'ru' => 'Basarabeasca',
                    'en' => 'Basarabeasca',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Bender',
                    'ru' => 'Bender',
                    'en' => 'Bender',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Briceni',
                    'ru' => 'Briceni',
                    'en' => 'Briceni',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Cahul',
                    'ru' => 'Cahul',
                    'en' => 'Cahul',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Călăraşi',
                    'ru' => 'Călăraşi',
                    'en' => 'Călăraşi',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Cantemir',
                    'ru' => 'Cantemir',
                    'en' => 'Cantemir',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Căuşeni',
                    'ru' => 'Căuşeni',
                    'en' => 'Căuşeni',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Cimişlia',
                    'ru' => 'Cimişlia',
                    'en' => 'Cimişlia',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Cocieri',
                    'ru' => 'Cocieri',
                    'en' => 'Cocieri',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Comrat',
                    'ru' => 'Comrat',
                    'en' => 'Comrat',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Criuleni',
                    'ru' => 'Criuleni',
                    'en' => 'Criuleni',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Donduşeni',
                    'ru' => 'Donduşeni',
                    'en' => 'Donduşeni',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Drochia',
                    'ru' => 'Drochia',
                    'en' => 'Drochia',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Edineţ',
                    'ru' => 'Edineţ',
                    'en' => 'Edineţ',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Făleşti',
                    'ru' => 'Făleşti',
                    'en' => 'Făleşti',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Floreşti',
                    'ru' => 'Floreşti',
                    'en' => 'Floreşti',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Glodeni',
                    'ru' => 'Glodeni',
                    'en' => 'Glodeni',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Hînceşti',
                    'ru' => 'Hînceşti',
                    'en' => 'Hînceşti',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Ialoveni',
                    'ru' => 'Ialoveni',
                    'en' => 'Ialoveni',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Leova',
                    'ru' => 'Leova',
                    'en' => 'Leova',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Nisporeni',
                    'ru' => 'Nisporeni',
                    'en' => 'Nisporeni',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Ocniţa',
                    'ru' => 'Ocniţa',
                    'en' => 'Ocniţa',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Orhei',
                    'ru' => 'Orhei',
                    'en' => 'Orhei',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Rezina',
                    'ru' => 'Rezina',
                    'en' => 'Rezina',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Rîşcani',
                    'ru' => 'Rîşcani',
                    'en' => 'Rîşcani',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Sîngerei',
                    'ru' => 'Sîngerei',
                    'en' => 'Sîngerei',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Şoldăneşti',
                    'ru' => 'Şoldăneşti',
                    'en' => 'Şoldăneşti',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Soroca',
                    'ru' => 'Soroca',
                    'en' => 'Soroca',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Ştefan Vodă',
                    'ru' => 'Ştefan Vodă',
                    'en' => 'Ştefan Vodă',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Straşeni',
                    'ru' => 'Straşeni',
                    'en' => 'Straşeni',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Taraclia',
                    'ru' => 'Taraclia',
                    'en' => 'Taraclia',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Teleneşti',
                    'ru' => 'Teleneşti',
                    'en' => 'Teleneşti',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Tiraspol',
                    'ru' => 'Tiraspol',
                    'en' => 'Tiraspol',
                ],
            ],
            [
                'name' => [
                    'ro' => 'Ungheni',
                    'ru' => 'Ungheni',
                    'en' => 'Ungheni',
                ],
            ],
    ];
        foreach ($regions as $region) {
            Country::where('iso2_code', 'MD')->firstOrFail()->regions()->create($region);
        }
    }
}
