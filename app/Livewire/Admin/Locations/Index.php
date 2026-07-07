<?php

namespace App\Livewire\Admin\Locations;

use App\Livewire\Admin\Support\TaxonomyIndex;
use App\Models\Location;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin.admin')]
#[Title('Locations')]
class Index extends TaxonomyIndex
{
    protected function modelClass(): string
    {
        return Location::class;
    }

    protected function resourceKey(): string
    {
        return 'location';
    }

    protected function routePrefix(): string
    {
        return 'admin.locations';
    }

    protected function title(): string
    {
        return __('Locations');
    }

    protected function countRelation(): ?string
    {
        return null;
    }

    protected function columns(): array
    {
        $types = [Location::TYPE_WAREHOUSE => __('Warehouse'), Location::TYPE_STORE => __('Store')];

        return [
            ['label' => __('Type'), 'value' => fn ($row) => $types[$row->type] ?? '—'],
        ];
    }
}
