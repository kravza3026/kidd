<?php

namespace App\Livewire\Admin\Brands;

use App\Livewire\Admin\Support\TaxonomyIndex;
use App\Models\Brand;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin.admin')]
#[Title('Brands')]
class Index extends TaxonomyIndex
{
    protected function modelClass(): string
    {
        return Brand::class;
    }

    protected function resourceKey(): string
    {
        return 'brand';
    }

    protected function routePrefix(): string
    {
        return 'admin.brands';
    }

    protected function title(): string
    {
        return __('Brands');
    }

    protected function columns(): array
    {
        return [
            ['label' => __('Products'), 'value' => fn ($row) => $row->products_count],
        ];
    }
}
