<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $country = Country::where('iso_alpha2', 'MD')->first();

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Anenii Noi',
                'ru' => 'р-н Анены Ной',
                'en' => 'Anenii Noi',
            ],
            'code' => 'AN',
            'external_code' => 2002,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'mun. Bălți',
                'ru' => 'мун. Бельцы',
                'en' => 'Balti',
            ],
            'code' => 'BA',
            'sort_order' => 0,
            'external_code' => 2035,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Basarabeasca',
                'ru' => 'р-н Бессарабка',
                'en' => 'Basarabeasca',
            ],
            'code' => 'BS',
            'external_code' => 2003,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Briceni',
                'ru' => 'р-н Бричаны',
                'en' => 'Briceni',
            ],
            'code' => 'BR',
            'external_code' => 2004,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Cahul',
                'ru' => 'р-н Кагул',
                'en' => 'Cahul',
            ],
            'code' => 'CA',
            'external_code' => 2005,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Călărași',
                'ru' => 'р-н Калараш',
                'en' => 'Calaras',
            ],
            'code' => 'CL',
            'external_code' => 2007,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Cantemir',
                'ru' => 'р-н Кантемир',
                'en' => 'Cantemir',
            ],
            'code' => 'CT',
            'external_code' => 2006,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Căușeni',
                'ru' => 'р-н Каушаны',
                'en' => 'Causeni',
            ],
            'code' => 'CS',
            'external_code' => 2008,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'mun. Chișinău',
                'ru' => 'мун. Кишинев',
                'en' => 'Chisinau',
            ],
            'code' => 'CH',
            'external_code' => 2034,
            'sort_order' => 0,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Cimișlia',
                'ru' => 'р-н Кимишля',
                'en' => 'Cimislia',
            ],
            'code' => 'CM',
            'external_code' => 2009,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Criuleni',
                'ru' => 'р-н Криуляны',
                'en' => 'Criuleni',
            ],
            'code' => 'CR',
            'external_code' => 2010,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Dondușeni',
                'ru' => 'р-н Дондюшаны',
                'en' => 'Donduseni',
            ],
            'code' => 'DO',
            'external_code' => 2011,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Drochia',
                'ru' => 'р-н Дрокия',
                'en' => 'Drochia',
            ],
            'code' => 'DR',
            'external_code' => 2012,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Dubăsari',
                'ru' => 'р-н Дубоссары',
                'en' => 'Dubasari',
            ],
            'code' => 'DU',
            'external_code' => 2013,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Edineț',
                'ru' => 'р-н Единец',
                'en' => 'Edinet',
            ],
            'code' => 'ED',
            'external_code' => 2014,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Fălești',
                'ru' => 'р-н Фалешты',
                'en' => 'Falesti',
            ],
            'code' => 'FA',
            'external_code' => 2015,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Florești',
                'ru' => 'р-н Флорешты',
                'en' => 'Floresti',
            ],
            'code' => 'FL',
            'external_code' => 2016,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Glodeni',
                'ru' => 'р-н Глодяны',
                'en' => 'Glodeni',
            ],
            'code' => 'GL',
            'external_code' => 2017,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Hîncești',
                'ru' => 'р-н Хынчешты',
                'en' => 'Hincesti',
            ],
            'code' => 'HI',
            'external_code' => 2018,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Ialoveni',
                'ru' => 'р-н Яловены',
                'en' => 'Ialoveni',
            ],
            'code' => 'IA',
            'external_code' => 2019,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Leova',
                'ru' => 'р-н Леова',
                'en' => 'Leova',
            ],
            'code' => 'LE',
            'external_code' => 2020,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Nisporeni',
                'ru' => 'р-н Ниспорены',
                'en' => 'Nisporeni',
            ],
            'code' => 'NI',
            'external_code' => 2021,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Ocnița',
                'ru' => 'р-н Окница',
                'en' => 'Ocnita',
            ],
            'code' => 'OC',
            'external_code' => 2022,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Orhei',
                'ru' => 'р-н Оргеев',
                'en' => 'Orhei',
            ],
            'code' => 'OR',
            'external_code' => 2023,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Rezina',
                'ru' => 'р-н Резина',
                'en' => 'Rezina',
            ],
            'code' => 'RE',
            'external_code' => 2024,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Rîșcani',
                'ru' => 'р-н Рышканы',
                'en' => 'Riscani',
            ],
            'code' => 'RI',
            'external_code' => 2025,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Sîngerei',
                'ru' => 'р-н Сынжерей',
                'en' => 'Singerei',
            ],
            'code' => 'SI',
            'external_code' => 2026,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Soroca',
                'ru' => 'р-н Сороки',
                'en' => 'Soroca',
            ],
            'code' => 'SO',
            'external_code' => 2027,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Șoldănești',
                'ru' => 'р-н Шолдэнешты',
                'en' => 'Soldanesti',
            ],
            'code' => 'SD',
            'external_code' => 2029,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Ștefan Vodă',
                'ru' => 'р-н Стефан Водэ',
                'en' => 'Stefan-Voda',
            ],
            'code' => 'SV',
            'external_code' => 2030,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Strășeni',
                'ru' => 'р-н Страшены',
                'en' => 'Staseni',
            ],
            'code' => 'ST',
            'external_code' => 2028,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Taraclia',
                'ru' => 'р-н Тараклия',
                'en' => 'Taraclia',
            ],
            'code' => 'TA',
            'external_code' => 2031,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Telenești',
                'ru' => 'р-н Теленешты',
                'en' => 'Telenesti',
            ],
            'code' => 'TE',
            'external_code' => 2032,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'r-nul Ungheni',
                'ru' => 'р-н Унгены',
                'en' => 'Ungheni',
            ],
            'code' => 'UN',
            'external_code' => 2033,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'Stânga Nistrului',
                'ru' => 'р-н Приднестровье',
                'en' => 'Transnistria',
            ],
            'code' => 'TR',
            'external_code' => 9999,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => [
                'ro' => 'UTA Găgăuzia',
                'ru' => 'р-н Гагаузия',
                'en' => 'Gagauzia',
            ],
            'code' => 'GA',
            'external_code' => 2037,
        ]);

    }
}
