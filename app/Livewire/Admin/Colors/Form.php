<?php

namespace App\Livewire\Admin\Colors;

use App\Livewire\Admin\Support\TaxonomyForm;
use App\Models\Color;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.admin')]
class Form extends TaxonomyForm
{
    public ?string $hex = null;

    public int $type = 1;

    public function mount(?Color $color = null): void
    {
        $this->init($color);
    }

    protected function fillExtra(Model $record): void
    {
        $this->hex = $record->hex;
        $this->type = (int) ($record->type ?? 1);
    }

    protected function applyTo(Model $record): void
    {
        parent::applyTo($record);
        $record->hex = $this->hex;
        $record->type = $this->type;
    }

    protected function extraFields(): array
    {
        return [
            ['model' => 'hex', 'label' => __('Hex color'), 'type' => 'text'],
            ['model' => 'type', 'label' => __('Type'), 'type' => 'select', 'options' => [
                1 => __('Clothes'),
                2 => __('Shoes'),
                3 => __('Accessory'),
            ]],
        ];
    }

    protected function extraRules(): array
    {
        return [
            'hex' => ['nullable', 'string', 'max:7'],
            'type' => ['required', 'integer', 'in:1,2,3'],
        ];
    }

    protected function modelClass(): string
    {
        return Color::class;
    }

    protected function resourceKey(): string
    {
        return 'color';
    }

    protected function routePrefix(): string
    {
        return 'admin.colors';
    }

    protected function title(): string
    {
        return __('Colors');
    }
}
