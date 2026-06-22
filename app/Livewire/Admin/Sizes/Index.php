<?php

namespace App\Livewire\Admin\Sizes;

use App\Livewire\Admin\Support\TaxonomyIndex;
use App\Models\Size;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin.admin')]
#[Title('Sizes')]
class Index extends TaxonomyIndex
{
    protected function modelClass(): string
    {
        return Size::class;
    }

    protected function resourceKey(): string
    {
        return 'size';
    }

    protected function routePrefix(): string
    {
        return 'admin.sizes';
    }

    protected function title(): string
    {
        return __('Sizes');
    }

    protected function columns(): array
    {
        $types = [Size::TYPE_CLOTH => __('Clothes'), Size::TYPE_SHOES => __('Shoes'), Size::TYPE_ACCESSORY => __('Accessory')];

        return [
            ['label' => __('Type'), 'value' => fn ($row) => $types[$row->type] ?? '—'],
            ['label' => __('Age (mo)'), 'value' => fn ($row) => $row->min_age.'–'.$row->max_age],
            ['label' => __('Products'), 'value' => fn ($row) => $row->products_count],
        ];
    }
}
