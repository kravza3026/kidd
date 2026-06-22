<?php

namespace App\Livewire\Admin\Tags;

use App\Livewire\Admin\Support\TaxonomyForm;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.admin')]
class Form extends TaxonomyForm
{
    public ?string $type = null;

    public function mount(?Tag $tag = null): void
    {
        $this->init($tag);
    }

    protected function fillExtra(Model $record): void
    {
        $this->type = $record->type;
    }

    protected function applyTo(Model $record): void
    {
        parent::applyTo($record);
        $record->type = $this->type ?: null;

        // Spatie tags persist a translatable slug; keep it in sync with the name per locale.
        $record->slug = collect($this->name)
            ->map(fn (string $value) => Str::slug($value))
            ->all();
    }

    protected function extraFields(): array
    {
        return [
            ['model' => 'type', 'label' => __('Type'), 'type' => 'text'],
        ];
    }

    protected function extraRules(): array
    {
        return [
            'type' => ['nullable', 'string', 'max:255'],
        ];
    }

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
}
