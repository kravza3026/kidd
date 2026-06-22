<?php

namespace App\Livewire\Admin\Warehouses;

use App\Livewire\Admin\Support\TaxonomyIndex;
use App\Models\Warehouse;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin.admin')]
#[Title('Warehouses')]
class Index extends TaxonomyIndex
{
    protected function modelClass(): string
    {
        return Warehouse::class;
    }

    protected function resourceKey(): string
    {
        return 'warehouse';
    }

    protected function routePrefix(): string
    {
        return 'admin.warehouses';
    }

    protected function title(): string
    {
        return __('Warehouses');
    }

    protected function countRelation(): ?string
    {
        return null;
    }

    protected function columns(): array
    {
        return [
            ['label' => __('Code'), 'value' => fn ($row) => $row->code],
        ];
    }
}
