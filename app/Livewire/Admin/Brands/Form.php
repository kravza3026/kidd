<?php

namespace App\Livewire\Admin\Brands;

use App\Livewire\Admin\Support\TaxonomyForm;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.admin')]
class Form extends TaxonomyForm
{
    /** @var array<string, string> */
    public array $description = [];

    public function mount(?Brand $brand = null): void
    {
        $this->description = array_fill_keys(array_keys(config('app.locales')), '');
        $this->init($brand);
    }

    protected function fillExtra(Model $record): void
    {
        $this->description = array_merge($this->description, $record->getTranslations('description'));
    }

    protected function applyTo(Model $record): void
    {
        parent::applyTo($record);
        $record->description = $this->description;
    }

    protected function withDescription(): bool
    {
        return true;
    }

    protected function extraRules(): array
    {
        $rules = [];
        foreach (array_keys(config('app.locales')) as $locale) {
            $rules["description.{$locale}"] = ['nullable', 'string', 'max:2000'];
        }

        return $rules;
    }

    protected function modelClass(): string
    {
        return Brand::class;
    }

    protected function resourceKey(): string
    {
        return 'brand';
    }

    protected function routePrefix(): string
    {
        return 'admin.brands';
    }

    protected function title(): string
    {
        return __('Brands');
    }
}
