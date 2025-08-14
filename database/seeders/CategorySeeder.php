<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clothes = Category::create([
            'parent_id' => null,
            'is_visible' => true,
            'name' => [
                'ro' => 'Haine',
                'ru' => 'Одежда',
                'en' => 'Clothing',
            ],
            'description' => [
                'ro' => 'Desc RO!',
                'ru' => 'Desc RU!',
                'en' => 'Desc EN!',
            ],
            'image' => null,
            'icon' => '',
        ]);

        Category::create([
            'parent_id' => $clothes->id,
            'is_visible' => true,
            'name' => [
                'ro' => 'Salopete',
                'ru' => 'Комбинезоны',
                'en' => 'Jumpsuits',
            ],
            'description' => [
                'ro' => 'Desc RO!',
                'ru' => 'Desc RU!',
                'en' => 'Desc EN!',
            ],
            'image' => 'categories/category_1.svg',
            'icon' => '<svg class="text-olive group-hover:text-white animated w-[24px] h-[24px] lg:w-[38px] lg:h-[38px]"  viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.28571 21.7L2.73695 19.6437C1.75688 19.2805 1.22175 18.2239 1.50889 17.2189L4.51054 6.71312C5.47673 3.33146 8.56761 1 12.0846 1V1C12.383 1 12.6557 1.16857 12.7891 1.43544L13.4179 2.69292C14.4751 4.80727 16.6361 6.14286 19 6.14286V6.14286C21.3639 6.14286 23.5249 4.80727 24.5821 2.69292L25.2109 1.43544C25.3443 1.16857 25.617 1 25.9154 1V1C29.4324 1 32.5233 3.33146 33.4895 6.71312L36.4911 17.2189C36.7783 18.2239 36.2431 19.2805 35.2631 19.6437L29.7143 21.7M8.28571 21.7V33.5193C8.28571 35.4416 9.84408 37 11.7664 37V37C13.2174 37 14.5161 36.1 15.0255 34.7414L17.6603 27.7155C18.1245 26.4776 19.8755 26.4776 20.3397 27.7155L22.9745 34.7414C23.4839 36.1 24.7826 37 26.2336 37V37C28.1559 37 29.7143 35.4416 29.7143 33.5193V21.7M8.28571 21.7V16.75M29.7143 21.7V16.75" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        ]);

        Category::create([
            'parent_id' => $clothes->id,
            'is_visible' => true,
            'name' => [
                'ro' => 'Jachete',
                'ru' => 'Куртки',
                'en' => 'Jackets',
            ],
            'description' => [
                'ro' => 'Desc RO!',
                'ru' => 'Desc RU!',
                'en' => 'Desc EN!',
            ],
            'image' => 'categories/category_2.svg',
            'icon' => '<svg class="text-olive group-hover:text-white animated w-[24px] h-[24px] lg:w-[38px] lg:h-[38px]"  viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.28571 21.7L2.73695 19.6437C1.75688 19.2805 1.22175 18.2239 1.50889 17.2189L4.51054 6.71312C5.47673 3.33146 8.56761 1 12.0846 1V1C12.383 1 12.6557 1.16857 12.7891 1.43544L13.4179 2.69292C14.4751 4.80727 16.6361 6.14286 19 6.14286V6.14286C21.3639 6.14286 23.5249 4.80727 24.5821 2.69292L25.2109 1.43544C25.3443 1.16857 25.617 1 25.9154 1V1C29.4324 1 32.5233 3.33146 33.4895 6.71312L36.4911 17.2189C36.7783 18.2239 36.2431 19.2805 35.2631 19.6437L29.7143 21.7M8.28571 21.7V33.5193C8.28571 35.4416 9.84408 37 11.7664 37V37C13.2174 37 14.5161 36.1 15.0255 34.7414L17.6603 27.7155C18.1245 26.4776 19.8755 26.4776 20.3397 27.7155L22.9745 34.7414C23.4839 36.1 24.7826 37 26.2336 37V37C28.1559 37 29.7143 35.4416 29.7143 33.5193V21.7M8.28571 21.7V16.75M29.7143 21.7V16.75" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        ]);

        Category::create([
            'parent_id' => $clothes->id,
            'is_visible' => true,
            'name' => [
                'ro' => 'Costume',
                'ru' => 'Костюмы',
                'en' => 'Bodysuits',
            ],
            'description' => [
                'ro' => 'Desc RO!',
                'ru' => 'Desc RU!',
                'en' => 'Desc EN!',
            ],
            'image' => 'categories/category_3.svg',
            'icon' => '<svg class="text-olive group-hover:text-white animated w-[24px] h-[24px] lg:w-[38px] lg:h-[38px]" viewBox="0 0 39 38" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.32744 21.709L2.81534 19.7196C1.70269 19.318 1.09517 18.1497 1.42115 17.0385L4.44951 6.71561C5.44199 3.33247 8.617 1 12.2297 1C12.5362 1 12.8164 1.16865 12.9534 1.43563L13.5993 2.69366C14.6852 4.80893 16.9051 6.1451 19.3333 6.1451C21.7616 6.1451 23.9814 4.80893 25.0674 2.69366L25.7132 1.43563C25.8503 1.16865 26.1305 1 26.437 1C30.0497 1 33.2247 3.33247 34.2172 6.71561L37.2455 17.0385C37.5715 18.1497 36.964 19.318 35.8513 19.7196L30.3393 21.709M8.32744 21.709V16.7569M8.32744 21.709L7.1956 25.4531M30.3393 21.709V16.7569M30.3393 21.709L31.4711 25.4531M19.3335 37C25.5066 37 33.2146 31.2204 31.4711 25.4531M19.3335 37C13.1604 37 5.45212 31.2204 7.1956 25.4531M19.3335 37L18.5383 29.0547C18.3337 27.0101 16.6131 25.4531 14.5582 25.4531H7.1956M19.3335 37L20.1286 29.0547C20.3333 27.0101 22.0539 25.4531 24.1088 25.4531H31.4711" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        ]);

        Category::create([
            'parent_id' => $clothes->id,
            'is_visible' => true,
            'name' => [
                'ro' => 'Pantaloni',
                'ru' => 'Брюки',
                'en' => 'Pants',
            ],
            'description' => [
                'ro' => 'Desc RO!',
                'ru' => 'Desc RU!',
                'en' => 'Desc EN!',
            ],
            'image' => 'categories/category_4.svg',
            'icon' => '<svg class="text-olive group-hover:text-white animated w-[24px] h-[24px] lg:w-[38px] lg:h-[38px]" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 7.75L1.82979 30.9322C1.39092 34.1414 3.88522 37 7.1243 37V37C9.38747 37 11.4052 35.5743 12.1612 33.4412L17.1149 19.4624C17.7442 17.6865 20.2558 17.6865 20.8851 19.4624L25.8388 33.4412C26.5948 35.5743 28.6125 37 30.8757 37V37C34.1148 37 36.6091 34.1414 36.1702 30.9322L33 7.75M5 7.75V3C5 1.89543 5.89543 1 7 1H31C32.1046 1 33 1.89543 33 3V7.75M5 7.75H33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        ]);

        Category::create([
            'parent_id' => $clothes->id,
            'is_visible' => true,
            'name' => [
                'ro' =>'Seturi',
                'ru' => 'Наборы',
                'en' => 'Sets',
            ],
            'description' => [
                'ro' => 'Desc RO!',
                'ru' => 'Desc RU!',
                'en' => 'Desc EN!',
            ],
            'image' => 'categories/category_5.svg',
            'icon' => '<svg class="text-olive group-hover:text-white animated w-[24px] h-[24px] lg:w-[38px] lg:h-[38px]" viewBox="0 0 43 42" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.17821 15.6622L2.86149 13.4309C1.85797 13.0764 1.38628 11.9804 1.83955 11.0563L3.92699 6.80059C5.66294 3.26145 9.39123 1 13.49 1H13.5758C13.8381 1 14.0866 1.11224 14.2527 1.30578L15.557 2.82529C16.3928 3.79893 17.6429 4.36359 18.9627 4.36359C20.2825 4.36359 21.5326 3.79893 22.3684 2.82529L23.6727 1.30578C23.8388 1.11224 24.0873 1 24.3496 1H24.4354C28.5342 1 32.2625 3.26145 33.9984 6.80059L36.0859 11.0563C36.5391 11.9804 36.0674 13.0764 35.0639 13.4309L28.7472 15.6622M9.17821 15.6622V10.3645M9.17821 15.6622V24.5451C9.17821 25.7273 10.1836 26.6856 11.4238 26.6856L15.557 26.7995M28.7472 10.3645V15.6622M15.719 25.3478V20.2642C15.719 19.0821 16.7244 18.1237 17.9646 18.1237H28.7472M15.719 25.3478H40.1714M15.719 25.3478L15.557 26.7995M40.1714 25.3478V20.2642C40.1714 19.0821 39.166 18.1237 37.9257 18.1237H28.7472M40.1714 25.3478L41.6538 38.6331C41.7949 39.8977 40.755 41 39.4208 41H32.2032C31.1928 41 30.3068 40.3568 30.0383 39.4283L28.2158 33.1255C28.14 32.8636 27.7503 32.8636 27.6746 33.1255L25.852 39.4283C25.5835 40.3568 24.6976 41 23.6871 41H16.4696C15.1354 41 14.0954 39.8977 14.2365 38.6331L15.557 26.7995M28.7472 18.1237V15.6622" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        ]);


//        Category::factory(30)->create();

    }
}
