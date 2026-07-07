<?php

namespace App\Livewire\Admin\Fabrics;

use App\Livewire\Admin\Support\TaxonomyIndex;
use App\Models\Fabric;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin.admin')]
#[Title('Fabrics')]
class Index extends TaxonomyIndex
{
    protected function modelClass(): string
    {
        return Fabric::class;
    }

    protected function resourceKey(): string
    {
        return 'fabric';
    }

    protected function routePrefix(): string
    {
        return 'admin.fabrics';
    }

    protected function title(): string
    {
        return __('Fabrics');
    }

    protected function columns(): array
    {
        return [
            ['label' => __('Products'), 'value' => fn ($row) => $row->products_count],
        ];
    }
}
