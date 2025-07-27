<?php /** @noinspection PhpExpressionResultUnusedInspection */

/** @noinspection PhpExpressionResultUnusedInspection */

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Vite;

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
            'image' => Vite::image('categories/category_1.svg'),
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
            'image' => Vite::image('categories/category_2.svg'),
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
            'image' => Vite::image('categories/category_3.svg'),
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
            'image' => Vite::image('categories/category_4.svg'),
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
            'image' => Vite::image('categories/placeholder.svg'),
        ]);


//        Category::factory(30)->create();

    }
}
