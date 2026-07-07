<?php

namespace App\Livewire\Admin\Roles;

use App\Support\AdminResources;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

#[Layout('layouts.admin.admin')]
class Form extends Component
{
    public ?Role $role = null;

    public string $name = '';

    /** @var array<int, string> */
    public array $selected = [];

    public function mount(?Role $role = null): void
    {
        if ($role?->exists) {
            $this->authorize('role.update');
            $this->role = $role;
            $this->name = $role->name;
            $this->selected = $role->permissions->pluck('name')->all();
        } else {
            $this->authorize('role.create');
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:60', Rule::unique('roles', 'name')->ignore($this->role?->id)],
            'selected' => ['array'],
            'selected.*' => ['string', Rule::in(AdminResources::permissions())],
        ];
    }

    /**
     * Toggle every permission of a resource on/off.
     */
    public function toggleResource(string $resource): void
    {
        $permissions = collect(AdminResources::ACTIONS)->map(fn ($action) => "{$resource}.{$action}")->all();
        $allSelected = empty(array_diff($permissions, $this->selected));

        $this->selected = $allSelected
            ? array_values(array_diff($this->selected, $permissions))
            : array_values(array_unique([...$this->selected, ...$permissions]));
    }

    public function save(): void
    {
        $this->validate();
        $editing = (bool) $this->role;

        $role = $this->role ?? new Role(['guard_name' => 'web']);
        $role->name = $this->name;
        $role->save();

        // Ensure the permissions exist before syncing.
        foreach ($this->selected as $permission) {
            Permission::findOrCreate($permission, 'web');
        }
        $role->syncPermissions($this->selected);

        session()->flash('success', $editing ? __('Role updated.') : __('Role created.'));

        $this->redirectRoute('admin.roles.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.roles.form', [
            'editing' => (bool) $this->role,
            'resources' => AdminResources::RESOURCES,
            'actions' => AdminResources::ACTIONS,
        ]);
    }
}
