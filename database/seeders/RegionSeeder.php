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
            'name' => ['ro' => 'r-nul Anenii Noi', 'ru' => 'р-н Анены Ной'],
            'code' => 'AN',
            'external_code' => 2002,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'mun. Bălți', 'ru' => 'мун. Бельцы'],
            'code' => 'BA',
            'sort_order' => 0,
            'external_code' => 2035,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Basarabeasca', 'ru' => 'р-н Бессарабка'],
            'code' => 'BS',
            'external_code' => 2003,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Briceni', 'ru' => 'р-н Бричаны'],
            'code' => 'BR',
            'external_code' => 2004,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Cahul', 'ru' => 'р-н Кагул'],
            'code' => 'CA',
            'external_code' => 2005,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Călărași', 'ru' => 'р-н Калараш'],
            'code' => 'CL',
            'external_code' => 2007,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Cantemir', 'ru' => 'р-н Кантемир'],
            'code' => 'CT',
            'external_code' => 2006,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Căușeni', 'ru' => 'р-н Каушаны'],
            'code' => 'CS',
            'external_code' => 2008,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'mun. Chișinău', 'ru' => 'мун. Кишинев'],
            'code' => 'CH',
            'external_code' => 2034,
            'sort_order' => 0,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Cimișlia', 'ru' => 'р-н Кимишля'],
            'code' => 'CM',
            'external_code' => 2009,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Criuleni', 'ru' => 'р-н Криуляны'],
            'code' => 'CR',
            'external_code' => 2010,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Dondușeni', 'ru' => 'р-н Дондюшаны'],
            'code' => 'DO',
            'external_code' => 2011,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Drochia', 'ru' => 'р-н Дрокия'],
            'code' => 'DR',
            'external_code' => 2012,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Dubăsari', 'ru' => 'р-н Дубоссары'],
            'code' => 'DU',
            'external_code' => 2013,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Edineț', 'ru' => 'р-н Единец'],
            'code' => 'ED',
            'external_code' => 2014,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Fălești', 'ru' => 'р-н Фалешты'],
            'code' => 'FA',
            'external_code' => 2015,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Florești', 'ru' => 'р-н Флорешты'],
            'code' => 'FL',
            'external_code' => 2016,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Glodeni', 'ru' => 'р-н Глодяны'],
            'code' => 'GL',
            'external_code' => 2017,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Hîncești', 'ru' => 'р-н Хынчешты'],
            'code' => 'HI',
            'external_code' => 2018,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Ialoveni', 'ru' => 'р-н Яловены'],
            'code' => 'IA',
            'external_code' => 2019,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Leova', 'ru' => 'р-н Леова'],
            'code' => 'LE',
            'external_code' => 2020,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Nisporeni', 'ru' => 'р-н Ниспорены'],
            'code' => 'NI',
            'external_code' => 2021,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Ocnița', 'ru' => 'р-н Окница'],
            'code' => 'OC',
            'external_code' => 2022,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Orhei', 'ru' => 'р-н Оргеев'],
            'code' => 'OR',
            'external_code' => 2023,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Rezina', 'ru' => 'р-н Резина'],
            'code' => 'RE',
            'external_code' => 2024,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Rîșcani', 'ru' => 'р-н Рышканы'],
            'code' => 'RI',
            'external_code' => 2025,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Sîngerei', 'ru' => 'р-н Сынжерей'],
            'code' => 'SI',
            'external_code' => 2026,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Soroca', 'ru' => 'р-н Сороки'],
            'code' => 'SO',
            'external_code' => 2027,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Șoldănești', 'ru' => 'р-н Шолдэнешты'],
            'code' => 'SD',
            'external_code' => 2029,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Ștefan Vodă', 'ru' => 'р-н Стефан Водэ'],
            'code' => 'SV',
            'external_code' => 2030,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Strășeni', 'ru' => 'р-н Страшены'],
            'code' => 'ST',
            'external_code' => 2028,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Taraclia', 'ru' => 'р-н Тараклия'],
            'code' => 'TA',
            'external_code' => 2031,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Telenești', 'ru' => 'р-н Теленешты'],
            'code' => 'TE',
            'external_code' => 2032,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'r-nul Ungheni', 'ru' => 'р-н Унгены'],
            'code' => 'UN',
            'external_code' => 2033,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'Stânga Nistrului', 'ru' => 'р-н Приднестровье'],
            'code' => 'TR',
            'external_code' => 9999,
        ]);

        Region::create([
            'country_id' => $country->id,
            'name' => ['ro' => 'UTA Găgăuzia', 'ru' => 'р-н Гагаузия'],
            'code' => 'GA',
            'external_code' => 2037,
        ]);

    }
}
