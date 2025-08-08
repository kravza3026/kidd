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
            'name' => ['ro' => 'Moldova', 'ru' => 'Молдова'],
            'iso_alpha2' => 'MD',
            'iso_alpha3' => 'MDA',
            'phone_code' => '+373',
            'currency_code' => 'MDL',
            'flag' => 'icons/flags/fl_ro.svg',
            'language' => 'Romanian',
            'language_code' => 'ro',
            'timezone' => 'Europe/Chisinau',
            'latitude' => 47.4116,
            'longitude' => 28.3699,
        ]);

        Country::create([
            'name' => ['ro' => 'România', 'ru' => 'Румыния'],
            'iso_alpha2' => 'RO',
            'iso_alpha3' => 'ROU',
            'phone_code' => '+40',
            'currency_code' => 'RON',
            'flag' => 'icons/flags/fl_ro.svg',
            'language' => 'Romanian',
            'language_code' => 'ro',
            'timezone' => 'Europe/Bucharest',
            'latitude' => 45.9432,
            'longitude' => 24.9668,
        ]);
    }
}
