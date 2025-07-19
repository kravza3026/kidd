<?php

namespace Database\Seeders;

use App\Enums\AddressType;
use App\Models\User;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(1);

        $user->addresses()->createMany([
            [
                'address_type' => AddressType::Shipping,
                'label' => 'Adresă livrare',
                'is_default' => true,
                'contact_first_name' => 'Eduard',
                'contact_last_name' => 'Zaim',
                'contact_phone' => '+37360558845',
                'contact_email' => 'edward@kidd.md',
                'company_name' => "Edward's Digital SRL",
                'company_code' => "ED",
                'vat_code' => "1015600010563",
                'street_name' => 'str. Trandafirilor',
                'building' => ' 11/5',
                'entrance' => '1',
                'floor' => '5',
                'apartment' => '33',
                'intercom' => '33',
                'city_id' => 1,
                'region_id' => 1,
                'country_id' => 1,
                'postal_code' => 'MD-2038',
                'notes' => 'Notiță adresă livrare.',
            ], [
                'address_type' => AddressType::Billing,
                'label' => 'Adresă facturare',
                'is_default' => true,
                'contact_first_name' => 'Eduard',
                'contact_last_name' => 'Zaim',
                'contact_phone' => '+37360558845',
                'contact_email' => 'edward@kidd.md',
                'company_name' => "Edward's Digital SRL",
                'company_code' => "ED",
                'vat_code' => "1015600010563",
                'street_name' => 'str. Trandafirilor',
                'building' => ' 11/5',
                'entrance' => '1',
                'floor' => '5',
                'apartment' => '33',
                'intercom' => '33',
                'city_id' => 1,
                'region_id' => 1,
                'country_id' => 1,
                'postal_code' => 'MD-2038',
                'notes' => 'Notiță adresă facturare.',
            ], [
                'address_type' => AddressType::Commercial,
                'label' => 'Adresa comercială',
                'is_default' => false,
                'contact_first_name' => 'Eduard',
                'contact_last_name' => 'Zaim',
                'contact_phone' => '+37360558845',
                'contact_email' => 'edward@kidd.md',
                'company_name' => "Edward's Digital SRL",
                'company_code' => "ED",
                'vat_code' => "1015600010563",
                'street_name' => 'str. Trandafirilor',
                'building' => ' 11/5',
                'entrance' => '1',
                'floor' => '5',
                'apartment' => '33',
                'intercom' => '33',
                'city_id' => 1,
                'region_id' => 1,
                'country_id' => 1,
                'postal_code' => 'MD-2038',
                'notes' => 'Notiță adresă comercială.',
            ], [
                'address_type' => AddressType::Private,
                'label' => 'Adresă privată',
                'is_default' => false,
                'contact_first_name' => 'Eduard',
                'contact_last_name' => 'Zaim',
                'contact_phone' => '+37360558845',
                'contact_email' => 'edward@kidd.md',
                'company_name' => "",
                'company_code' => "",
                'vat_code' => "",
                'street_name' => 'str. Trandafirilor',
                'building' => ' 11/5',
                'entrance' => '1',
                'floor' => '5',
                'apartment' => '33',
                'intercom' => '33',
                'city_id' => 1,
                'region_id' => 1,
                'country_id' => 1,
                'postal_code' => 'MD-2038',
                'notes' => 'Notiță adresă privată.',
            ]
        ]);
    }
}
