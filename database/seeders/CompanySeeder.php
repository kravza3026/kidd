<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'Edwards Digital SRL',
            'idno' => '1234567890',
            'logo' => 'https://via.placeholder.com/150',
            'description' => 'This is a test company.',

            'email' => 'edward@kidd.md',
            'phone' => '+373 60 55 88 45',
            'website' => 'https://kidd.md',

            'address_line_1' => '123 Test St',
            'address_line_2' => 'Apt 123',
            'city' => 'Test City',
            'country' => 'Test Country',

            'tva' => 20,

            'bank_name' => 'Test Bank',
            'bank_branch' => 'Test Branch',
            'bank_account' => '1234567890',
            'bank_swift' => 'TESTMD22',
            'bank_iban' => 'MD1234567890',
            'bank_bic' => 'TESTMD22XXX',
            'bank_code' => '1234567890',
            'bank_address' => '123 Test St',
            'bank_city' => 'Test City',
            'bank_country' => 'Test Country',

            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'youtube' => 'https://youtube.com',
            'pinterest' => 'https://pinterest.com',
            'tiktok' => 'https://tiktok.com',
            'whatsapp' => 'https://whatsapp.com',
            'telegram' => 'https://telegram.com',
            'viber' => 'https://viber.com',
        ]);

    }
}
