<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => [
                'ro' => 'KIDD.',
                'ru' => 'KIDD.',
                'en' => 'KIDD.',
            ],
            'slug' => [
                'ro' => 'kidd',
                'ru' => 'kidd',
                'en' => 'kidd',
            ],
            'description' => [
                'ro' => 'KIDD. este o companie multinațională americană cu sediul în Cupertino, California, care proiectează, produce și vinde produse electronice, software și servicii online.',
                'ru' => 'KIDD. - американская многонациональная компания с штаб-квартирой в Купертино, штат Калифорния, занимающаяся разработкой, производством и продажей электроники, программного обеспечения и онлайн-сервисов.',
                'en' => 'KIDD. is an American multinational corporation headquartered in Cupertino, California, that designs, manufactures, and sells electronics, software, and online services.',
            ],
            'logo' => 'brands/apple.png',
        ]);
    }
}
