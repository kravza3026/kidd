<?php

namespace App\Livewire\Admin\Cities;

use App\Livewire\Admin\Support\TaxonomyIndex;
use App\Models\City;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin.admin')]
#[Title('Cities')]
class Index extends TaxonomyIndex
{
    protected function modelClass(): string
    {
        return City::class;
    }

    protected function resourceKey(): string
    {
        return 'city';
    }

    protected function routePrefix(): string
    {
        return 'admin.cities';
    }

    protected function title(): string
    {
        return __('Cities');
    }

    protected function countRelation(): ?string
    {
        return null;
    }

    protected function columns(): array
    {
        $locale = app()->getLocale();

        return [
            ['label' => __('Region'), 'value' => fn ($row) => $row->region?->getTranslation('name', $locale) ?? '—'],
        ];
    }
}
