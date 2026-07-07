<?php

namespace App\Livewire\Admin\Users;

use App\Livewire\Concerns\WithDataTable;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Users')]
class Index extends Component
{
    use WithDataTable;

    public function mount(): void
    {
        $this->authorize('viewAny', User::class);
    }

    public function delete(int $id): void
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);

        if ($user->id === auth()->id()) {
            $this->dispatch('toast', type: 'error', message: __('You cannot delete yourself.'));

            return;
        }

        $user->delete();
        $this->dispatch('toast', type: 'success', message: __('User deleted.'));
    }

    public function render(): View
    {
        $sortable = ['id', 'first_name', 'last_name', 'email', 'created_at'];
        $sort = in_array($this->sortField, $sortable, true) ? $this->sortField : 'id';

        $users = User::query()
            ->with('roles')
            ->when($this->search !== '', function ($query) {
                $term = '%'.$this->search.'%';
                $query->where(fn ($q) => $q->where('first_name', 'ilike', $term)
                    ->orWhere('last_name', 'ilike', $term)
                    ->orWhere('email', 'ilike', $term));
            })
            ->orderBy($sort, $this->safeSortDirection())
            ->paginate($this->perPage);

        return view('livewire.admin.users.index', compact('users'));
    }
}
