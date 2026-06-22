<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Gender;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            RegionSeeder::class,
            CitySeeder::class,
            CompanySeeder::class,
            RolesSeeder::class,
            PermissionsSeeder::class,
            UserSeeder::class,
            AddressSeeder::class,
            BrandSeeder::class,
            GenderSeeder::class,
            SeasonSeeder::class,
            ColorSeeder::class,
            FabricSeeder::class,
            SizeSeeder::class,
            CareInstructionSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            WarehouseSeeder::class,
            InventorySeeder::class,
            LocationSeeder::class,
            VacancySeeder::class,
        ]);

        Family::create([
            'user_id' => 1,
            'gender_id' => Gender::BOY,
            'name' => 'Sebastian',
            'birth_date' => '2024-08-25',
            'height' => 90,
            'weight' => 13200,
            'notes' => 'Test Sebastian Note!',
        ]);

        Family::create([
            'user_id' => 1,
            'gender_id' => Gender::GIRL,
            'name' => 'Melisa',
            'birth_date' => '2024-09-28',
            'height' => 79,
            'weight' => 10500,
            'notes' => 'Test Melisa Note!',
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
