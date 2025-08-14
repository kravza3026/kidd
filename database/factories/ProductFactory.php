<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_visible' => true,

            'category_id' => rand(2, 6), //Category::factory(),
            'brand_id' => 1,
            'gender_id' => rand(1, 3),
            'season_id' => rand(1, 5),
            'fabric_id' => rand(1, 5),


            'name' => [
                'ro' => fake()->randomElement([
                    'Salopetă Bumbac Organic pentru Bebeluși',
                    'Body cu Mânecă Lungă pentru Nou-născuți',
                    'Pijama Pufoasă din Velur',
                    'Set 3 Piese pentru Bebeluși',
                    'Rochița de Vară pentru Fetițe',
                    'Hanorac cu Glugă pentru Băieței',
                    'Costum de Baie pentru Bebeluși',
                    'Pantalonași cu Bretele Elegante',
                    'Căciulița Caldă de Iarnă',
                    'Costum Bumbac pentru Primii Pași',
                ]),
                'ru' => fake()->randomElement([
                    'Органический Хлопковый Комбинезон',
                    'Боди с Длинным Рукавом для Новорожденных',
                    'Велюровая Пижама',
                    'Комплект из 3 Предметов',
                    'Летнее Платье для Девочек',
                    'Худи с Капюшоном для Мальчиков',
                    'Купальный Костюм для Малышей',
                    'Штанишки с Подтяжками',
                    'Теплая Зимняя Шапочка',
                    'Мягкие Носочки для Первых Шагов',
                ]),
                'en' => fake()->randomElement([
                    'Organic Cotton Baby Romper',
                    'Long Sleeve Newborn Bodysuit',
                    'Soft Velour Sleepsuit',
                    '3-Piece Baby Set',
                    'Girls Summer Dress',
                    'Boys Hooded Sweatshirt',
                    'Baby Swimsuit',
                    'Suspender Pants',
                    'Warm Winter Hat',
                    'Soft First Steps Socks',
                ])
            ],
            'description' => [
                'ro' => fake()->randomElement([
                    'Confecționat din bumbac organic 100%, acest articol este perfect pentru pielea sensibilă a bebelușului. Închidere cu capse pentru schimbare ușoară a scutecului. Disponibil în mărimi de la 0-24 luni.',
                    'Design ergonomic special creat pentru copiii mici, cu zone elastice pentru mișcare liberă și confort maxim. Disponibil în culori vesele și prietenoase.'
                ]),
                'ru' => fake()->randomElement([
                    'Изготовлено из 100% органического хлопка, идеально подходит для чувствительной кожи малыша. Застежки-кнопки для легкой смены подгузника. Доступно в размерах от 0-24 месяцев.',
                    'Эргономичный дизайн, специально созданный для малышей, с эластичными зонами для свободного движения и максимального комфорта. Доступно в веселых и дружелюбных цветах.'
                ]),
                'en' => fake()->randomElement([
                    'Complete baby set including bodysuit, pants, and matching bib. All pieces are OEKO-TEX Standard 100 certified materials.',
                    'Ergonomic design specially created for toddlers, with elastic zones for free movement and maximum comfort. Available in cheerful and friendly colors.',
                ])
            ],

            'main_image' => 'products/product_'.rand(1, 9).'.png',

            'rating' => rand(1, 5),
            'review_count' => fake()->randomNumber(rand(2, 3)),

            'is_new' => rand(0, 1),
            'has_discount' => rand(0, 1),
            'is_featured' => rand(0, 1),
            'is_bestseller' => rand(0, 1),

            'barcode' => fake()->ean13(),
        ];
    }
}
