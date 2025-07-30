<?php

namespace Database\Seeders;

use App\Enums\AddressType;
use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $main_warehouse = Location::create([
            'name' => [
                'ro' => 'Depozit #1',
                'ru' => 'Склад #1',
                'en' => 'Warehouse #1',
            ],
            'type' => 1, // Type 1 - Warehouse
            'geo_position' => [
                'lat' => '47.0226291',
                'lng' => '28.8670329',
            ],
            'open_hours' => [
                'ro' => 'Lu-Vi: 08-20, Sb: 9-19, Du: 10-17',
                'ru' => 'Пн-Пт: 08-20, Сб: 9-19, Вс: 10-17',
                'en' => 'Mo-Fr: 08-20, Sa: 9-19, Su: 10-17',
            ],
        ]);

        $main_warehouse->address()->create([
            'address_type' => AddressType::Commercial,
            'label' => 'Depozit #1',
            'is_default' => false,
            'contact_first_name' => 'Edward',
            'contact_last_name' => 'Z',
            'contact_phone' => '+37360558845',
            'contact_email' => 'warehouse@kidd.md',
            'company_name' => "S&M Retail SRL",
            'company_code' => "SMR",
            'vat_code' => "1015600010567",
            'street_name' => 'str. Muncești',
            'building' => '3',
            'entrance' => null,
            'floor' => '3',
            'apartment' => null,
            'intercom' => null,
            'city_id' => 1,
            'region_id' => 1,
            'country_id' => 1,
            'postal_code' => 'MD-2046',
            'notes' => 'Adresă depozit principal.',
        ]);

        $main_store = Location::create([
            'name' => [
                'ro' => 'Magazin #3',
                'ru' => 'Магазин #3',
                'en' => 'Store #3',
            ],
            'type' => 2, // Type 2 - Store
            'geo_position' => [
                'lat' => '47.0144034',
                'lng' => '28.8561766',
            ],
            'open_hours' => [
                'ro' => 'Lu-Vi: 08-17, Sb: 9-17, Du: 10-15',
                'ru' => 'Пн-Пт: 08-17, Сб: 9-17, Вс: 10-15',
                'en' => 'Mo-Fr: 08-17, Sa: 9-17, Su: 10-15',
            ],
        ]);

        $main_store->address()->create([
            'address_type' => AddressType::Commercial,
            'label' => 'Magazin #3',
            'is_default' => false,
            'contact_first_name' => 'Edward',
            'contact_last_name' => 'Z',
            'contact_phone' => '+37360558845',
            'contact_email' => 'store3@kidd.md',
            'company_name' => "S&M Retail SRL",
            'company_code' => "SMR",
            'vat_code' => "1015600010567",
            'street_name' => 'str. Arborilor',
            'building' => '21',
            'entrance' => null,
            'floor' => '2',
            'apartment' => null,
            'intercom' => null,
            'city_id' => 1,
            'region_id' => 1,
            'country_id' => 1,
            'postal_code' => 'MD-2012',
            'notes' => 'Adresă magazin #3.',
        ]);

        $franchise = Location::create([
            'name' => [
                'ro' => 'Magazin #7',
                'ru' => 'Магазин #7',
                'en' => 'Store #7',
            ],
            'type' => 2, // Type 2 - Store
            'geo_position' => [
                'lat' => '46.9918719',
                'lng' => '28.8580194',
            ],
            'open_hours' => [
                'ro' => 'Lu-Vi: 08-17, Sb: 9-17, Du: 10-22',
                'ru' => 'Пн-Пт: 08-17, Сб: 9-17, Вс: 10-22',
                'en' => 'Mo-Fr: 08-17, Sa: 9-17, Su: 10-22',
            ],
        ]);

        $franchise->address()->create([
            'address_type' => AddressType::Commercial,
            'label' => 'Magazin #7',
            'is_default' => false,
            'contact_first_name' => 'Edward',
            'contact_last_name' => 'Z',
            'contact_phone' => '+37360558845',
            'contact_email' => 'store7@kidd.md',
            'company_name' => "S&M Retail SRL",
            'company_code' => "SMR",
            'vat_code' => "1015600010567",
            'street_name' => 'str. Decebal',
            'building' => '6/1',
            'entrance' => '2',
            'floor' => '1',
            'apartment' => null,
            'intercom' => null,
            'city_id' => 1,
            'region_id' => 1,
            'country_id' => 1,
            'postal_code' => 'MD-2038',
            'notes' => 'Adresă magazin #7 Decebal.',
        ]);

    }
}
