<?php

namespace App\Livewire\Admin\Regions;

use App\Livewire\Admin\Support\TaxonomyIndex;
use App\Models\Region;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin.admin')]
#[Title('Regions')]
class Index extends TaxonomyIndex
{
    protected function modelClass(): string
    {
        return Region::class;
    }

    protected function resourceKey(): string
    {
        return 'region';
    }

    protected function routePrefix(): string
    {
        return 'admin.regions';
    }

    protected function title(): string
    {
        return __('Regions');
    }

    protected function countRelation(): ?string
    {
        return 'cities';
    }

    protected function columns(): array
    {
        return [
            ['label' => __('Code'), 'value' => fn ($row) => $row->code],
            ['label' => __('Cities'), 'value' => fn ($row) => $row->cities_count],
        ];
    }
}
