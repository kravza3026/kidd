<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = Region::all();

        foreach ($regions as $region) {
            $request = Http::acceptJson()->get('https://main-api.posta.md/nomenclatures/cities', [
                'page' => 1,
                'per_page' => 1000,
                'region' => $region->external_code,
            ]);

            foreach ($request->json()['results'] as $city) {
                $region->cities()->create([
                    'name' => ['ro' => $city['name'], 'ru' => $city['name']],
                    'external_code' => $city['code'],
                ]);
            }
        }
    }
}
