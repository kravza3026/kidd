<?php

namespace App\Livewire\Admin\Roles;

use App\Livewire\Concerns\WithDataTable;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Layout('layouts.admin.admin')]
#[Title('Roles')]
class Index extends Component
{
    use WithDataTable;

    /**
     * Roles that may not be deleted from the UI.
     *
     * @var list<string>
     */
    private const PROTECTED = ['admin'];

    public function mount(): void
    {
        $this->authorize('role.viewAny');
    }

    public function delete(int $id): void
    {
        $this->authorize('role.delete');
        $role = Role::findOrFail($id);

        if (in_array($role->name, self::PROTECTED, true)) {
            $this->dispatch('toast', type: 'error', message: __('This role is protected.'));

            return;
        }

        $role->delete();
        $this->dispatch('toast', type: 'success', message: __('Role deleted.'));
    }

    public function render(): View
    {
        $sortable = ['id', 'name'];
        $sort = in_array($this->sortField, $sortable, true) ? $this->sortField : 'name';

        $roles = Role::query()
            ->withCount(['permissions', 'users'])
            ->when($this->search !== '', fn ($q) => $q->where('name', 'ilike', '%'.$this->search.'%'))
            ->orderBy($sort, $this->safeSortDirection() === 'asc' ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.roles.index', [
            'roles' => $roles,
            'protected' => self::PROTECTED,
        ]);
    }
}
