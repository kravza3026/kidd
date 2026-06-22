<?php

namespace App\Livewire\Admin\Support;

use App\Models\AttributeGroup;
use App\Models\Concerns\BelongsToAttributeGroup;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

/**
 * Shared create/edit form for simple translatable taxonomy resources. Concrete subclasses
 * provide a typed mount() for route-model binding that delegates to init(), and may add
 * fields by overriding applyTo()/extraRules()/withDescription().
 */
abstract class TaxonomyForm extends Component
{
    public ?int $recordId = null;

    /**
     * Generic translatable label bag, bound by the shared Blade as `wire-model="name"`.
     * It persists to the model attribute named by labelAttribute() — usually `name`, but
     * `title` for resources like CareInstruction. Keep the property name `name` so the
     * Blade binding and `name.{locale}` validation/error keys stay aligned.
     *
     * @var array<string, string>
     */
    public array $name = [];

    /**
     * Optional translatable description bag, persisted only when withDescription() is true.
     *
     * @var array<string, string>
     */
    public array $description = [];

    public int $sort_order = 0;

    /** Optional group this item belongs to (AttributeGroup id). */
    public ?int $attribute_group_id = null;

    /** @return class-string<Model> */
    abstract protected function modelClass(): string;

    abstract protected function resourceKey(): string;

    abstract protected function routePrefix(): string;

    abstract protected function title(): string;

    /** Model attribute the label bag persists to. */
    protected function labelAttribute(): string
    {
        return 'name';
    }

    /** Label shown above the translatable field. */
    protected function nameLabel(): string
    {
        return __('Name');
    }

    /**
     * Groups are available only to models that opt in via the BelongsToAttributeGroup trait
     * (the catalog attributes). Other taxonomy on this base (regions, companies, …) have no
     * attribute_group_id column and skip grouping automatically.
     */
    protected function supportsGroups(): bool
    {
        return in_array(
            BelongsToAttributeGroup::class,
            class_uses_recursive($this->modelClass()),
            true,
        );
    }

    protected function init(?Model $record): void
    {
        $locales = array_keys(config('app.locales'));
        $this->name = array_fill_keys($locales, '');
        $this->description = array_fill_keys($locales, '');

        if ($record?->exists) {
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->name = array_merge($this->name, $record->getTranslations($this->labelAttribute()));
            if ($this->withDescription()) {
                $this->description = array_merge($this->description, $record->getTranslations('description'));
            }
            $this->sort_order = (int) ($record->sort_order ?? 0);
            if ($this->supportsGroups()) {
                $this->attribute_group_id = $record->attribute_group_id;
            }
            $this->fillExtra($record);
        } else {
            $this->authorize('create', $this->modelClass());
        }
    }

    protected function fillExtra(Model $record): void {}

    protected function applyTo(Model $record): void
    {
        $record->{$this->labelAttribute()} = $this->name;
        $record->sort_order = $this->sort_order;
        if ($this->supportsGroups()) {
            $record->attribute_group_id = $this->attribute_group_id;
        }

        if ($this->withDescription()) {
            $record->description = $this->description;
        }
    }

    protected function withDescription(): bool
    {
        return false;
    }

    /**
     * Extra scalar fields rendered after name/description.
     *
     * @return array<int, array{model: string, label: string, type?: string, options?: array<int|string, string>}>
     */
    protected function extraFields(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function extraRules(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        $rules = ['sort_order' => ['integer', 'min:0', 'max:65535']];

        if ($this->supportsGroups()) {
            $rules['attribute_group_id'] = ['nullable', 'integer', 'exists:attribute_groups,id'];
        }

        foreach (array_keys(config('app.locales')) as $locale) {
            $rules["name.{$locale}"] = ['required', 'string', 'max:255'];

            if ($this->withDescription()) {
                $rules["description.{$locale}"] = ['nullable', 'string', 'max:2000'];
            }
        }

        return array_merge($rules, $this->extraRules());
    }

    public function save(): void
    {
        $this->validate();

        $class = $this->modelClass();
        $editing = (bool) $this->recordId;
        $record = $editing ? $class::findOrFail($this->recordId) : new $class;

        $this->applyTo($record);
        $record->save();

        session()->flash('success', $editing ? __('Saved.') : __('Created.'));

        $this->redirectRoute($this->routePrefix().'.index', navigate: true);
    }

    public function render(): View
    {
        $locale = app()->getLocale();

        return view('livewire.admin.taxonomy.form', [
            'title' => $this->title(),
            'routePrefix' => $this->routePrefix(),
            'editing' => (bool) $this->recordId,
            'withDescription' => $this->withDescription(),
            'extraFields' => $this->extraFields(),
            'nameLabel' => $this->nameLabel(),
            'groups' => $this->supportsGroups()
                ? AttributeGroup::forAttribute($this->resourceKey())->get()->mapWithKeys(fn ($g) => [$g->id => $g->getTranslation('name', $locale)])
                : collect(),
        ]);
    }
}
