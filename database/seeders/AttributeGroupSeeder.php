<?php

namespace Database\Seeders;

use App\Models\AttributeGroup;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Seeds example editable groups for the catalog attributes that ship with a `type`
 * (sizes & colors) and assigns existing rows to the matching group. Groups are fully
 * editable afterwards from the admin (add/rename/reorder/delete + drag items between).
 */
class AttributeGroupSeeder extends Seeder
{
    /**
     * type value => [ro, ru, en] group name.
     */
    private const GROUPS = [
        1 => ['Îmbrăcăminte', 'Одежда', 'Clothing'],
        2 => ['Încălțăminte', 'Обувь', 'Shoes'],
        3 => ['Accesorii', 'Аксессуары', 'Accessories'],
    ];

    public function run(): void
    {
        $this->seedFor('size', Size::class);
        $this->seedFor('color', Color::class);
    }

    /**
     * @param  class-string<Model>  $model
     */
    private function seedFor(string $attribute, string $model): void
    {
        $groupsByType = [];

        foreach (self::GROUPS as $type => [$ro, $ru, $en]) {
            $groupsByType[$type] = AttributeGroup::firstOrCreate(
                ['attribute' => $attribute, 'name->en' => $en],
                ['name' => ['ro' => $ro, 'ru' => $ru, 'en' => $en], 'sort_order' => $type],
            )->id;
        }

        foreach ($model::query()->whereNull('attribute_group_id')->get() as $row) {
            $type = (int) ($row->type ?? 1);
            $row->update(['attribute_group_id' => $groupsByType[$type] ?? $groupsByType[1]]);
        }
    }
}
