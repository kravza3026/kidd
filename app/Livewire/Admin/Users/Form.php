<?php

namespace App\Livewire\Admin\Users;

use App\Models\Company;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Propaganistas\LaravelPhone\Rules\Phone;
use Spatie\Permission\Models\Role;

#[Layout('layouts.admin.admin')]
class Form extends Component
{
    public ?User $user = null;

    public string $first_name = '';

    public string $last_name = '';

    public string $email = '';

    public string $phone = '';

    public ?string $password = null;

    public ?int $company_id = null;

    /** @var array<int, string> */
    public array $roles = [];

    public function mount(?User $user = null): void
    {
        if ($user?->exists) {
            $this->authorize('update', $user);
            $this->user = $user;
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->phone = (string) $user->phone;
            $this->company_id = $user->company_id;
            $this->roles = $user->roles->pluck('name')->all();
        } else {
            $this->authorize('create', User::class);
            $this->company_id = Company::query()->value('id');
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:40'],
            'last_name' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:80', Rule::unique('users', 'email')->ignore($this->user?->id)],
            'phone' => ['required', (new Phone)->country(['MD', 'RO'])],
            'password' => [$this->user ? 'nullable' : 'required', 'min:6'],
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'roles' => ['array'],
            'roles.*' => ['string', Rule::exists('roles', 'name')],
        ];
    }

    public function save(): void
    {
        $this->validate();
        $editing = (bool) $this->user;

        $user = $this->user ?? new User;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->company_id = $this->company_id;
        if (filled($this->password)) {
            $user->password = $this->password; // hashed via cast
        }
        $user->save();

        $user->syncRoles($this->roles);

        session()->flash('success', $editing ? __('User updated.') : __('User created.'));

        $this->redirectRoute('admin.users.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.users.form', [
            'editing' => (bool) $this->user,
            'companies' => Company::orderBy('name')->pluck('name', 'id'),
            'allRoles' => Role::orderBy('name')->pluck('name'),
        ]);
    }
}
