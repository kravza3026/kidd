<?php

namespace App\Livewire\Admin\Genders;

use App\Livewire\Admin\Support\TaxonomyIndex;
use App\Models\Gender;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin.admin')]
#[Title('Genders')]
class Index extends TaxonomyIndex
{
    protected function modelClass(): string
    {
        return Gender::class;
    }

    protected function resourceKey(): string
    {
        return 'gender';
    }

    protected function routePrefix(): string
    {
        return 'admin.genders';
    }

    protected function title(): string
    {
        return __('Genders');
    }

    protected function columns(): array
    {
        return [
            ['label' => __('Code'), 'value' => fn ($row) => $row->code ?? '—'],
            ['label' => __('Products'), 'value' => fn ($row) => $row->products_count],
        ];
    }
}
