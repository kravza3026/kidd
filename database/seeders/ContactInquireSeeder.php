<?php

namespace Database\Seeders;

use App\Models\ContactInquire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactInquireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactInquire::create([
            'first_name' => 'Edward',
            'last_name' => 'Zed',
            'phone' => '+37379001122',
            'email' => 'edward@kidd.md',
            'message' => 'Hello, I would like to inquire about your products.',
        ]);
    }
}
