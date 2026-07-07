<?php

namespace App\Livewire\Admin\Companies;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
class Form extends Component
{
    public ?Company $company = null;

    public string $name = '';

    public ?string $idno = null;

    public ?string $email = null;

    public ?string $phone = null;

    public ?string $website = null;

    public int $tva = 20;

    public bool $active = true;

    public function mount(?Company $company = null): void
    {
        if ($company?->exists) {
            $this->authorize('update', $company);
            $this->company = $company;
            $this->name = (string) $company->name;
            $this->idno = $company->idno;
            $this->email = $company->email;
            $this->phone = $company->phone;
            $this->website = $company->website;
            $this->tva = (int) ($company->tva ?? 20);
            $this->active = (int) $company->status === 1;
        } else {
            $this->authorize('create', Company::class);
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'idno' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'website' => ['nullable', 'string', 'max:255'],
            'tva' => ['integer', 'min:0', 'max:100'],
            'active' => ['boolean'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        $editing = (bool) $this->company;

        $company = $this->company ?? new Company;
        $company->name = $this->name;
        $company->idno = $this->idno;
        $company->email = $this->email;
        $company->phone = $this->phone;
        $company->website = $this->website;
        $company->tva = $this->tva;
        $company->status = $this->active ? 1 : 0;
        $company->save();

        session()->flash('success', $editing ? __('Company updated.') : __('Company created.'));

        $this->redirectRoute('admin.companies.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.companies.form', ['editing' => (bool) $this->company]);
    }
}
