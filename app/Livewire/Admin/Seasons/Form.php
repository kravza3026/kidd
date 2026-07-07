<?php

namespace App\Livewire\Admin\Seasons;

use App\Livewire\Admin\Support\TaxonomyForm;
use App\Models\Season;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.admin')]
class Form extends TaxonomyForm
{
    public function mount(?Season $season = null): void
    {
        $this->init($season);
    }

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
}
