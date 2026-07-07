<?php

namespace App\Livewire\Admin\Cities;

use App\Livewire\Admin\Support\TaxonomyForm;
use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.admin')]
class Form extends TaxonomyForm
{
    public ?int $region_id = null;

    public function mount(?City $city = null): void
    {
        $this->init($city);

        if (! $this->recordId) {
            $this->region_id = Region::query()->value('id');
        }
    }

    protected function fillExtra(Model $record): void
    {
        $this->region_id = $record->region_id;
    }

    protected function applyTo(Model $record): void
    {
        parent::applyTo($record);
        $record->region_id = $this->region_id;
    }

    protected function extraFields(): array
    {
        $locale = app()->getLocale();

        return [
            ['model' => 'region_id', 'label' => __('Region'), 'type' => 'select',
                'options' => Region::all()->mapWithKeys(fn ($r) => [$r->id => $r->getTranslation('name', $locale)])->all()],
        ];
    }

    protected function extraRules(): array
    {
        return [
            'region_id' => ['required', 'integer', 'exists:regions,id'],
        ];
    }

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
}
