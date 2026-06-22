<?php

namespace App\Livewire\Admin\Tags;

use App\Livewire\Admin\Support\TaxonomyIndex;
use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin.admin')]
#[Title('Tags')]
class Index extends TaxonomyIndex
{
    protected function modelClass(): string
    {
        return Tag::class;
    }

    protected function resourceKey(): string
    {
        return 'tag';
    }

    protected function routePrefix(): string
    {
        return 'admin.tags';
    }

    protected function title(): string
    {
        return __('Tags');
    }

    protected function countRelation(): ?string
    {
        return null;
    }

    protected function columns(): array
    {
        return [
            ['label' => __('Type'), 'value' => fn ($row) => $row->type ?: '—'],
            ['label' => __('Sort'), 'value' => fn ($row) => $row->sort_order ?? 0],
        ];
    }
}
