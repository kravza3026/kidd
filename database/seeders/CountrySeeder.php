<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create([
            'name' => [
                'ro' => 'Moldova',
                'ru' => 'Молдова',
                'en' => 'Moldova',
            ],
            'iso2_code' => 'MD',
            'iso3_code' => 'MDA',
            'phone_code' => '373',
        ]);

        Country::create([
            'name' => [
                'ro' => 'România',
                'ru' => 'Румыния',
                'en' => 'Romania',
            ],
            'iso2_code' => 'RO',
            'iso3_code' => 'ROU',
            'phone_code' => '40',
        ]);
    }
}
