<?php /** @noinspection PhpExpressionResultUnusedInspection */

/** @noinspection PhpExpressionResultUnusedInspection */

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
            'image' => "https://tailwindui.com/img/ecommerce-images/home-page-02-edition-01.jpg",
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
            'image' => "https://tailwindui.com/img/ecommerce-images/home-page-02-edition-02.jpg",
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
            'image' => "https://tailwindui.com/img/ecommerce-images/home-page-02-edition-03.jpg",
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
            'image' => "https://tailwindui.com/img/ecommerce-images/home-page-02-edition-01.jpg",
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
            'image' => "https://tailwindui.com/img/ecommerce-images/home-page-02-edition-02.jpg",
        ]);


//        Category::factory(30)->create();

    }
}
