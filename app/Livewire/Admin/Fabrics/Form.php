<?php

namespace App\Livewire\Admin\Fabrics;

use App\Livewire\Admin\Support\TaxonomyForm;
use App\Models\Fabric;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.admin')]
class Form extends TaxonomyForm
{
    public function mount(?Fabric $fabric = null): void
    {
        $this->init($fabric);
    }

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
}
