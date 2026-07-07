<?php

namespace App\Livewire\Admin\CareInstructions;

use App\Livewire\Admin\Support\TaxonomyForm;
use App\Models\CareInstruction;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.admin')]
class Form extends TaxonomyForm
{
    public ?string $icon = null;

    public function mount(?CareInstruction $careInstruction = null): void
    {
        $this->init($careInstruction);
    }

    protected function fillExtra(Model $record): void
    {
        $this->icon = $record->icon;
    }

    protected function applyTo(Model $record): void
    {
        parent::applyTo($record);
        $record->icon = $this->icon;

        // `name` is a legacy non-null internal identifier; the storefront shows title/description.
        // Keep it in sync with the default-locale title so the column stays meaningful.
        $defaultLocale = array_key_first(config('app.locales'));
        $record->name = $this->name[$defaultLocale] ?? reset($this->name) ?: '—';
    }

    protected function extraFields(): array
    {
        return [
            ['model' => 'icon', 'label' => __('Icon'), 'type' => 'text'],
        ];
    }

    protected function extraRules(): array
    {
        return [
            'icon' => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function labelAttribute(): string
    {
        return 'title';
    }

    protected function nameLabel(): string
    {
        return __('Instruction');
    }

    protected function withDescription(): bool
    {
        return true;
    }

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
}
