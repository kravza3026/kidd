<?php

namespace App\Livewire\Admin\Regions;

use App\Livewire\Admin\Support\TaxonomyForm;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.admin')]
class Form extends TaxonomyForm
{
    public string $code = '';

    public ?int $country_id = null;

    public function mount(?Region $region = null): void
    {
        $this->init($region);

        if (! $this->recordId) {
            $this->country_id = Country::query()->value('id');
        }
    }

    protected function fillExtra(Model $record): void
    {
        $this->code = (string) $record->code;
        $this->country_id = $record->country_id;
    }

    protected function applyTo(Model $record): void
    {
        parent::applyTo($record);
        $record->code = strtoupper($this->code);
        $record->country_id = $this->country_id;
    }

    protected function extraFields(): array
    {
        $locale = app()->getLocale();

        return [
            ['model' => 'code', 'label' => __('Code'), 'type' => 'text'],
            ['model' => 'country_id', 'label' => __('Country'), 'type' => 'select',
                'options' => Country::all()->mapWithKeys(fn ($c) => [$c->id => $c->getTranslation('name', $locale)])->all()],
        ];
    }

    protected function extraRules(): array
    {
        return [
            'code' => ['required', 'string', 'max:2'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
        ];
    }

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
}
