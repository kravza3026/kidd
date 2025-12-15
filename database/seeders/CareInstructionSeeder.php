<?php

namespace Database\Seeders;

use App\Models\CareInstruction;
use Illuminate\Database\Seeder;

class CareInstructionSeeder extends Seeder
{
    public function run(): void
    {
        $instructions = [

            [
                'name' => 'Wash 30 deg instruction',
                'sort_order' => 1,
                'icon' => 'wash-30',
                'title' => [
                    'ro' => 'Spălați la 30° pentru a proteja țesătura',
                    'ru' => 'Стирать при 30°, чтобы сохранить ткань',
                    'en' => 'Wash at 30° to protect the fabric',
                ],
                'description' => [
                    'ro' => 'Folosiți un ciclu delicat',
                    'ru' => 'Используйте деликатный режим',
                    'en' => 'Use a gentle cycle',
                ],
            ],

            [
                'name' => 'Wash 40 deg instruction',
                'sort_order' => 2,
                'icon' => 'wash-40',
                'title' => [
                    'ro' => 'Spălați la 40° pentru o curățare mai eficientă',
                    'ru' => 'Стирать при 40° для более эффективной очистки',
                    'en' => 'Wash at 40° for more effective cleaning',
                ],
                'description' => [
                    'ro' => 'Evitați stoarcerea excesivă',
                    'ru' => 'Избегайте сильного отжима',
                    'en' => 'Avoid excessive spin',
                ],
            ],

            [
                'name' => 'Wash 60 deg instruction',
                'sort_order' => 3,
                'icon' => 'wash-60',
                'title' => [
                    'ro' => 'Spălați la 60° pentru igienizare',
                    'ru' => 'Стирать при 60° для гигиенической обработки',
                    'en' => 'Wash at 60° for hygienic cleaning',
                ],
                'description' => [
                    'ro' => 'Recomandat pentru textile rezistente',
                    'ru' => 'Подходит для прочных тканей',
                    'en' => 'Recommended for durable fabrics',
                ],
            ],

            [
                'name' => 'Wash 90 deg instruction',
                'sort_order' => 4,
                'icon' => 'wash-90',
                'title' => [
                    'ro' => 'Spălați la 90° pentru a păstra calitatea și culoarea țesăturii',
                    'ru' => 'Стирать при 90° для сохранения качества и цвета ткани',
                    'en' => 'Wash at 90° to preserve the quality and colour of the fabric',
                ],
                'description' => [
                    'ro' => 'Evitați folosirea înălbitorilor',
                    'ru' => 'Избегайте использования отбеливателя',
                    'en' => 'Avoid using bleach',
                ],
            ],

            [
                'name' => 'Hand wash instruction',
                'sort_order' => 5,
                'icon' => 'wash-hand',
                'title' => [
                    'ro' => 'Spălare manuală',
                    'ru' => 'Ручная стирка',
                    'en' => 'Hand wash',
                ],
                'description' => [
                    'ro' => 'Folosiți apă rece sau călduță',
                    'ru' => 'Используйте холодную или тёплую воду',
                    'en' => 'Use cold or lukewarm water',
                ],
            ],

            [
                'name' => 'Do not wash instruction',
                'sort_order' => 6,
                'icon' => 'no-wash',
                'title' => [
                    'ro' => 'Nu se spală',
                    'ru' => 'Не стирать',
                    'en' => 'Do not wash',
                ],
                'description' => [
                    'ro' => 'Curățare profesională recomandată',
                    'ru' => 'Рекомендуется профессиональная чистка',
                    'en' => 'Professional cleaning recommended',
                ],
            ],

            [
                'name' => 'Do not bleach',
                'sort_order' => 7,
                'icon' => 'no-bleach',
                'title' => [
                    'ro' => 'Nu folosiți înălbitor',
                    'ru' => 'Не использовать отбеливатель',
                    'en' => 'Do not bleach',
                ],
                'description' => [
                    'ro' => 'Poate deteriora țesătura',
                    'ru' => 'Может повредить ткань',
                    'en' => 'Can damage the fabric',
                ],
            ],

            [
                'name' => 'Bleach allowed',
                'sort_order' => 8,
                'icon' => 'bleach',
                'title' => [
                    'ro' => 'Se poate folosi înălbitor',
                    'ru' => 'Разрешено использовать отбеливатель',
                    'en' => 'Bleach allowed',
                ],
                'description' => [
                    'ro' => 'Folosiți doar înălbitori fără clor',
                    'ru' => 'Используйте только бесхлорный отбеливатель',
                    'en' => 'Use non-chlorine bleach only',
                ],
            ],

            [
                'name' => 'Tumble dry low instruction',
                'sort_order' => 9,
                'icon' => 'tumble-low',
                'title' => [
                    'ro' => 'Uscare în uscător la temperatură joasă',
                    'ru' => 'Сушить в сушилке на низкой температуре',
                    'en' => 'Tumble dry low',
                ],
                'description' => [
                    'ro' => 'Evitați suprauscarea',
                    'ru' => 'Избегайте пересушивания',
                    'en' => 'Avoid overdrying',
                ],
            ],

            [
                'name' => 'Tumble dry medium instruction',
                'sort_order' => 10,
                'icon' => 'tumble-medium',
                'title' => [
                    'ro' => 'Uscare în uscător la temperatură medie',
                    'ru' => 'Сушить в сушилке при средней температуре',
                    'en' => 'Tumble dry medium',
                ],
                'description' => [
                    'ro' => 'Potrivit pentru textile obișnuite',
                    'ru' => 'Подходит для обычных тканей',
                    'en' => 'Suitable for standard fabrics',
                ],
            ],

            [
                'name' => 'Tumble dry high instruction',
                'sort_order' => 11,
                'icon' => 'tumble-high',
                'title' => [
                    'ro' => 'Uscare în uscător la temperatură înaltă',
                    'ru' => 'Сушить в сушилке на высокой температуре',
                    'en' => 'Tumble dry high',
                ],
                'description' => [
                    'ro' => 'Poate cauza micșorare',
                    'ru' => 'Может вызвать усадку',
                    'en' => 'May cause shrinkage',
                ],
            ],

            [
                'name' => 'Do not tumble dry instruction',
                'sort_order' => 12,
                'icon' => 'no-tumble',
                'title' => [
                    'ro' => 'Nu folosiți uscătorul',
                    'ru' => 'Не использовать сушилку',
                    'en' => 'Do not tumble dry',
                ],
                'description' => [
                    'ro' => 'Uscați natural pe suport',
                    'ru' => 'Сушите естественным способом',
                    'en' => 'Air dry naturally',
                ],
            ],

            [
                'name' => 'Line dry instruction',
                'sort_order' => 13,
                'icon' => 'line-dry',
                'title' => [
                    'ro' => 'Uscare pe sârmă',
                    'ru' => 'Сушить на верёвке',
                    'en' => 'Line dry',
                ],
                'description' => [
                    'ro' => 'Evitați expunerea directă la soare',
                    'ru' => 'Избегайте прямых солнечных лучей',
                    'en' => 'Avoid direct sunlight',
                ],
            ],

            [
                'name' => 'Dry flat instruction',
                'sort_order' => 14,
                'icon' => 'dry-flat',
                'title' => [
                    'ro' => 'Uscare pe suprafață plană',
                    'ru' => 'Сушить в разложенном виде',
                    'en' => 'Dry flat',
                ],
                'description' => [
                    'ro' => 'Previne deformarea',
                    'ru' => 'Предотвращает деформацию',
                    'en' => 'Prevents deformation',
                ],
            ],

            [
                'name' => 'Iron low heat instruction',
                'sort_order' => 15,
                'icon' => 'iron-low',
                'title' => [
                    'ro' => 'Călcați la temperatură joasă',
                    'ru' => 'Гладить при низкой температуре',
                    'en' => 'Iron on low heat',
                ],
                'description' => [
                    'ro' => 'Potrivit pentru materiale sensibile',
                    'ru' => 'Подходит для чувствительных тканей',
                    'en' => 'Suitable for delicate fabrics',
                ],
            ],

            [
                'name' => 'Iron medium heat instruction',
                'sort_order' => 16,
                'icon' => 'iron-medium',
                'title' => [
                    'ro' => 'Călcați la temperatură medie',
                    'ru' => 'Гладить при средней температуре',
                    'en' => 'Iron on medium heat',
                ],
                'description' => [
                    'ro' => 'Evitați aburul excesiv',
                    'ru' => 'Избегайте чрезмерного пара',
                    'en' => 'Avoid excessive steam',
                ],
            ],

            [
                'name' => 'Iron high heat instruction',
                'sort_order' => 17,
                'icon' => 'iron-high',
                'title' => [
                    'ro' => 'Călcați la temperatură înaltă',
                    'ru' => 'Гладить при высокой температуре',
                    'en' => 'Iron on high heat',
                ],
                'description' => [
                    'ro' => 'Potrivit pentru bumbac și in',
                    'ru' => 'Подходит для хлопка и льна',
                    'en' => 'Suitable for cotton and linen',
                ],
            ],

            [
                'name' => 'Do not iron instruction',
                'sort_order' => 18,
                'icon' => 'no-iron',
                'title' => [
                    'ro' => 'Nu călcați',
                    'ru' => 'Не гладить',
                    'en' => 'Do not iron',
                ],
                'description' => [
                    'ro' => 'Poate topi materialul',
                    'ru' => 'Может расплавить материал',
                    'en' => 'May melt the fabric',
                ],
            ],

            [
                'name' => 'Dry clean only instruction',
                'sort_order' => 19,
                'icon' => 'dryclean-p',
                'title' => [
                    'ro' => 'Doar curățare chimică',
                    'ru' => 'Только химчистка',
                    'en' => 'Dry clean only',
                ],
                'description' => [
                    'ro' => 'Evitați curățarea acasă',
                    'ru' => 'Избегайте домашней стирки',
                    'en' => 'Avoid home washing',
                ],
            ],

            [
                'name' => 'Do not dry clean instruction',
                'sort_order' => 20,
                'icon' => 'no-dryclean',
                'title' => [
                    'ro' => 'Nu curățați chimic',
                    'ru' => 'Не сдавать в химчистку',
                    'en' => 'Do not dry clean',
                ],
                'description' => [
                    'ro' => 'Substanțele chimice pot deteriora țesătura',
                    'ru' => 'Химикаты могут повредить ткань',
                    'en' => 'Chemicals may damage the fabric',
                ],
            ],

        ];

        foreach ($instructions as $instruction) {
            CareInstruction::create($instruction);
        }
    }
}
