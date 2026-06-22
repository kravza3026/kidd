<?php

namespace App\Livewire\Admin\Colors;

use App\Livewire\Admin\Support\TaxonomyIndex;
use App\Models\Color;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin.admin')]
#[Title('Colors')]
class Index extends TaxonomyIndex
{
    protected function modelClass(): string
    {
        return Color::class;
    }

    protected function resourceKey(): string
    {
        return 'color';
    }

    protected function routePrefix(): string
    {
        return 'admin.colors';
    }

    protected function title(): string
    {
        return __('Colors');
    }

    protected function columns(): array
    {
        return [
            ['label' => __('Hex'), 'value' => fn ($row) => $row->hex ?? '—'],
            ['label' => __('Products'), 'value' => fn ($row) => $row->products_count],
        ];
    }
}
