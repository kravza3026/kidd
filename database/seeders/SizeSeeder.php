<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Size::create([
            'name' => [
                'ro' => 'Nou-născut',
                'ru' => 'Новорожденный',
                'en' => 'Newborn',
            ],
            'slug' => [
                'ro' => 'nou-nascut',
                'ru' => 'novorozhdennyy',
                'en' => 'newborn',
            ],
            'min_height' => '25',
            'max_height' => '53',
            'min_weight' => '1000',
            'max_weight' => '4000',
            'min_age' => '0',
            'max_age' => '1',
        ]);

        Size::create([
            'name' => [
                'ro' => '0-3L',
                'ru' => '0-3М',
                'en' => '0-3M',
            ],
            'slug' => [
                'ro' => '0-3l',
                'ru' => '0-3m',
                'en' => '0-3m',
            ],
            'min_height' => '53',
            'max_height' => '61',
            'min_weight' => '3600',
            'max_weight' => '5400',
            'min_age' => '0',
            'max_age' => '3',
        ]);

        Size::create([
            'name' => [
                'ro' => '3-6L',
                'ru' => '3-6М',
                'en' => '3-6M',
            ],
            'slug' => [
                'ro' => '3-6l',
                'ru' => '3-6m',
                'en' => '3-6m',
            ],
            'min_height' => '61',
            'max_height' => '66',
            'min_weight' => '5400',
            'max_weight' => '7300',
            'min_age' => '3',
            'max_age' => '6',
        ]);

        Size::create([
            'name' => [
                'ro' => '6-9L',
                'ru' => '6-9М',
                'en' => '6-9M',
            ],
            'slug' => [
                'ro' => '6-9l',
                'ru' => '6-9m',
                'en' => '6-9m',
            ],
            'min_height' => '66',
            'max_height' => '71',
            'min_weight' => '7300',
            'max_weight' => '8600',
            'min_age' => '6',
            'max_age' => '9',
        ]);

        Size::create([
            'name' => [
                'ro' => '9-12L',
                'ru' => '9-12М',
                'en' => '9-12M',
            ],
            'slug' => [
                'ro' => '9-12l',
                'ru' => '9-12m',
                'en' => '9-12m',
            ],
            'min_height' => '71',
            'max_height' => '76',
            'min_weight' => '8600',
            'max_weight' => '10000',
            'min_age' => '9',
            'max_age' => '12',
        ]);

        Size::create([
            'name' => [
                'ro' => '12-18L',
                'ru' => '12-18М',
                'en' => '12-18M',
            ],
            'slug' => [
                'ro' => '12-18l',
                'ru' => '12-18m',
                'en' => '12-18m',
            ],
            'min_height' => '76',
            'max_height' => '81',
            'min_weight' => '10000',
            'max_weight' => '11300',
            'min_age' => '12',
            'max_age' => '18',
        ]);

        Size::create([
            'name' => [
                'ro' => '18-24L',
                'ru' => '18-24М',
                'en' => '18-24M',
            ],
            'slug' => [
                'ro' => '18-24l',
                'ru' => '18-24m',
                'en' => '18-24m',
            ],
            'min_height' => '81',
            'max_height' => '86',
            'min_weight' => '11300',
            'max_weight' => '12700',
            'min_age' => '18',
            'max_age' => '24',
        ]);

        Size::create([
            'name' => [
                'ro' => '2T',
                'ru' => '2Т',
                'en' => '2T',
            ],
            'slug' => [
                'ro' => '2t',
                'ru' => '2t',
                'en' => '2t',
            ],
            'min_height' => '86',
            'max_height' => '94',
            'min_weight' => '12700',
            'max_weight' => '14000',
            'min_age' => '24',
            'max_age' => '36',
        ]);
    }
}
