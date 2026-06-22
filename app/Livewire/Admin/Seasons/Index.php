<?php

namespace App\Livewire\Admin\Seasons;

use App\Livewire\Admin\Support\TaxonomyIndex;
use App\Models\Season;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin.admin')]
#[Title('Seasons')]
class Index extends TaxonomyIndex
{
    protected function modelClass(): string
    {
        return Season::class;
    }

    protected function resourceKey(): string
    {
        return 'season';
    }

    protected function routePrefix(): string
    {
        return 'admin.seasons';
    }

    protected function title(): string
    {
        return __('Seasons');
    }

    protected function columns(): array
    {
        return [
            ['label' => __('Products'), 'value' => fn ($row) => $row->products_count],
        ];
    }
}
