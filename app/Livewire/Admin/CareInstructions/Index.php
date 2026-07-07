<?php

namespace App\Livewire\Admin\CareInstructions;

use App\Livewire\Admin\Support\TaxonomyIndex;
use App\Models\CareInstruction;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin.admin')]
#[Title('Care instructions')]
class Index extends TaxonomyIndex
{
    protected function modelClass(): string
    {
        return CareInstruction::class;
    }

    protected function resourceKey(): string
    {
        return 'careInstruction';
    }

    protected function routePrefix(): string
    {
        return 'admin.care-instructions';
    }

    protected function title(): string
    {
        return __('Care instructions');
    }

    protected function labelAttribute(): string
    {
        return 'title';
    }

    protected function labelHeading(): string
    {
        return __('Instruction');
    }

    protected function countRelation(): ?string
    {
        return null;
    }

    protected function columns(): array
    {
        return [
            ['label' => __('Icon'), 'value' => fn ($row) => $row->icon ?? '—'],
            ['label' => __('Sort'), 'value' => fn ($row) => $row->sort_order],
        ];
    }
}
