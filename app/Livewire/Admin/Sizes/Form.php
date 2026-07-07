<?php

namespace App\Livewire\Admin\Sizes;

use App\Livewire\Admin\Support\TaxonomyForm;
use App\Models\Size;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.admin')]
class Form extends TaxonomyForm
{
    public int $type = Size::TYPE_CLOTH;

    public int $min_age = 0;

    public int $max_age = 0;

    public int $min_height = 0;

    public int $max_height = 0;

    public int $min_weight = 0;

    public int $max_weight = 0;

    public function mount(?Size $size = null): void
    {
        $this->init($size);
    }

    protected function fillExtra(Model $record): void
    {
        foreach (['type', 'min_age', 'max_age', 'min_height', 'max_height', 'min_weight', 'max_weight'] as $attr) {
            $this->{$attr} = (int) ($record->{$attr} ?? 0);
        }
    }

    protected function applyTo(Model $record): void
    {
        parent::applyTo($record);
        foreach (['type', 'min_age', 'max_age', 'min_height', 'max_height', 'min_weight', 'max_weight'] as $attr) {
            $record->{$attr} = $this->{$attr};
        }
    }

    protected function extraFields(): array
    {
        return [
            ['model' => 'type', 'label' => __('Type'), 'type' => 'select', 'options' => [
                Size::TYPE_CLOTH => __('Clothes'),
                Size::TYPE_SHOES => __('Shoes'),
                Size::TYPE_ACCESSORY => __('Accessory'),
            ]],
            ['model' => 'min_age', 'label' => __('Min age (months)'), 'type' => 'number'],
            ['model' => 'max_age', 'label' => __('Max age (months)'), 'type' => 'number'],
            ['model' => 'min_height', 'label' => __('Min height (cm)'), 'type' => 'number'],
            ['model' => 'max_height', 'label' => __('Max height (cm)'), 'type' => 'number'],
            ['model' => 'min_weight', 'label' => __('Min weight (g)'), 'type' => 'number'],
            ['model' => 'max_weight', 'label' => __('Max weight (g)'), 'type' => 'number'],
        ];
    }

    protected function extraRules(): array
    {
        $rules = ['type' => ['required', 'integer', 'in:1,2,3']];
        foreach (['min_age', 'max_age', 'min_height', 'max_height', 'min_weight', 'max_weight'] as $attr) {
            $rules[$attr] = ['integer', 'min:0', 'max:65535'];
        }

        return $rules;
    }

    protected function modelClass(): string
    {
        return Size::class;
    }

    protected function resourceKey(): string
    {
        return 'size';
    }

    protected function routePrefix(): string
    {
        return 'admin.sizes';
    }

    protected function title(): string
    {
        return __('Sizes');
    }
}
