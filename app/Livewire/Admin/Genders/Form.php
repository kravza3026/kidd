<?php

namespace App\Livewire\Admin\Genders;

use App\Livewire\Admin\Support\TaxonomyForm;
use App\Models\Gender;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.admin')]
class Form extends TaxonomyForm
{
    public ?string $code = null;

    public ?string $bg_color = null;

    public function mount(?Gender $gender = null): void
    {
        $this->init($gender);
    }

    protected function fillExtra(Model $record): void
    {
        $this->code = $record->code;
        $this->bg_color = $record->getRawOriginal('bg_color');
    }

    protected function applyTo(Model $record): void
    {
        parent::applyTo($record);
        $record->code = $this->code;
        $record->bg_color = $this->bg_color;
    }

    protected function extraFields(): array
    {
        return [
            ['model' => 'code', 'label' => __('Code'), 'type' => 'text'],
            ['model' => 'bg_color', 'label' => __('Background color'), 'type' => 'text'],
        ];
    }

    protected function extraRules(): array
    {
        return [
            'code' => ['nullable', 'string', 'max:1'],
            'bg_color' => ['nullable', 'string', 'max:50'],
        ];
    }

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
}
