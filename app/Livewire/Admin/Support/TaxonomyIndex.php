<?php

namespace App\Livewire\Admin\Support;

use App\Livewire\Concerns\WithDataTable;
use App\Models\AttributeGroup;
use App\Models\Concerns\BelongsToAttributeGroup;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

/**
 * Shared index for simple translatable taxonomy resources (brands, seasons, fabrics, …).
 * Items are shown grouped by their editable AttributeGroup and can be drag-reordered (and
 * dragged between groups). Concrete subclasses declare their model, permission key, route
 * prefix and columns.
 */
abstract class TaxonomyIndex extends Component
{
    use WithDataTable;

    public bool $managingGroups = false;

    /**
     * Editable group names, keyed by group id then locale (bound by the manage-groups panel).
     *
     * @var array<int, array<string, string>>
     */
    public array $groupNames = [];

    /** @return class-string<Model> */
    abstract protected function modelClass(): string;

    abstract protected function resourceKey(): string;

    abstract protected function routePrefix(): string;

    abstract protected function title(): string;

    /** @return array<int, array{label: string, value: callable}> */
    abstract protected function columns(): array;

    /**
     * The translatable model attribute used as the primary label column. Most taxonomy
     * uses `name`; resources like CareInstruction (which store `title`) override this.
     */
    protected function labelAttribute(): string
    {
        return 'name';
    }

    /** Heading shown above the label column. */
    protected function labelHeading(): string
    {
        return __('Name');
    }

    protected function countRelation(): ?string
    {
        return 'products';
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

    public function mount(): void
    {
        $this->authorize('viewAny', $this->modelClass());
        if ($this->supportsGroups()) {
            $this->loadGroupNames();
        }
    }

    public function delete(int $id): void
    {
        $model = $this->modelClass()::findOrFail($id);
        $this->authorize('delete', $model);
        $model->delete();

        $this->dispatch('toast', type: 'success', message: __('Deleted.'));
    }

    /**
     * Reorder an item within its group, or move it to another group, after a drag.
     * $groupId is the destination group's id (empty string ⇒ ungrouped).
     */
    public function reorderItem(int $id, int $position, mixed $groupId = null): void
    {
        if (! $this->supportsGroups()) {
            return;
        }

        $model = $this->modelClass();
        $item = $model::findOrFail($id);
        $this->authorize('update', $item);

        $targetGroupId = $groupId ? (int) $groupId : null;

        if ($targetGroupId !== null
            && ! AttributeGroup::query()->whereKey($targetGroupId)->where('attribute', $this->resourceKey())->exists()) {
            return;
        }

        $siblings = $model::query()
            ->where('attribute_group_id', $targetGroupId)
            ->whereKeyNot($id)
            ->orderBy('sort_order')->orderBy('id')
            ->pluck('id')->all();

        $position = max(0, min($position, count($siblings)));
        array_splice($siblings, $position, 0, [$id]);

        $item->forceFill(['attribute_group_id' => $targetGroupId])->save();
        foreach ($siblings as $index => $siblingId) {
            $model::query()->whereKey($siblingId)->update(['sort_order' => $index]);
        }
    }

    public function addGroup(): void
    {
        $this->authorize($this->resourceKey().'.update');

        AttributeGroup::create([
            'attribute' => $this->resourceKey(),
            'name' => array_fill_keys(array_keys(config('app.locales')), __('New group')),
            'sort_order' => (int) AttributeGroup::forAttribute($this->resourceKey())->max('sort_order') + 1,
        ]);

        $this->loadGroupNames();
    }

    public function saveGroups(): void
    {
        $this->authorize($this->resourceKey().'.update');

        foreach ($this->groupNames as $id => $names) {
            AttributeGroup::query()->whereKey($id)->where('attribute', $this->resourceKey())
                ->first()?->update(['name' => $names]);
        }

        $this->dispatch('toast', type: 'success', message: __('Groups saved.'));
    }

    public function deleteGroup(int $id): void
    {
        $this->authorize($this->resourceKey().'.update');

        AttributeGroup::query()->whereKey($id)->where('attribute', $this->resourceKey())->first()?->delete();
        $this->loadGroupNames();

        $this->dispatch('toast', type: 'success', message: __('Group deleted.'));
    }

    public function reorderGroup(int $id, int $position): void
    {
        $this->authorize($this->resourceKey().'.update');

        $ids = AttributeGroup::forAttribute($this->resourceKey())->whereKeyNot($id)->pluck('id')->all();
        $position = max(0, min($position, count($ids)));
        array_splice($ids, $position, 0, [$id]);

        foreach ($ids as $index => $groupId) {
            AttributeGroup::query()->whereKey($groupId)->update(['sort_order' => $index]);
        }

        $this->loadGroupNames();
    }

    protected function loadGroupNames(): void
    {
        $this->groupNames = AttributeGroup::forAttribute($this->resourceKey())->get()
            ->mapWithKeys(fn ($group) => [$group->id => $group->getTranslations('name')])
            ->all();
    }

    public function render(): View
    {
        $locale = app()->getLocale();
        $model = $this->modelClass();
        $label = $this->labelAttribute();

        $query = $model::query();
        if ($this->countRelation()) {
            $query->withCount($this->countRelation());
        }
        $query->when($this->search !== '', fn ($q) => $q->where("{$label}->{$locale}", 'ilike', '%'.$this->search.'%'));

        // The catalog attributes (which opt into groups) get the grouped, drag-sortable view;
        // every other taxonomy keeps the paginated table.
        if ($this->supportsGroups()) {
            return view('livewire.admin.taxonomy.grouped', [
                'groups' => AttributeGroup::forAttribute($this->resourceKey())->get(),
                'items' => $query->orderBy('sort_order')->orderBy('id')->get(),
                'searching' => $this->search !== '',
                'supportsGroups' => true,
                'title' => $this->title(),
                'routePrefix' => $this->routePrefix(),
                'resource' => $this->resourceKey(),
                'columns' => $this->columns(),
                'labelAttribute' => $label,
                'labelHeading' => $this->labelHeading(),
                'locales' => array_keys(config('app.locales')),
            ]);
        }

        $sort = $this->sortField === $label ? "{$label}->{$locale}" : $this->sortField;

        return view('livewire.admin.taxonomy.index', [
            'rows' => $query->orderBy($sort, $this->safeSortDirection())->paginate($this->perPage),
            'title' => $this->title(),
            'routePrefix' => $this->routePrefix(),
            'resource' => $this->resourceKey(),
            'columns' => $this->columns(),
            'labelAttribute' => $label,
            'labelHeading' => $this->labelHeading(),
        ]);
    }
}
