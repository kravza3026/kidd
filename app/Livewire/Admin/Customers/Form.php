<?php

namespace App\Livewire\Admin\Customers;

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
class Form extends Component
{
    public ?Customer $customer = null;

    public string $first_name = '';

    public string $last_name = '';

    public string $email = '';

    public string $phone = '';

    public ?int $company_id = null;

    public function mount(?Customer $customer = null): void
    {
        if ($customer?->exists) {
            $this->authorize('update', $customer);
            $this->customer = $customer;
            $this->fill($customer->only(['first_name', 'last_name', 'email', 'phone', 'company_id']));
        } else {
            $this->authorize('create', Customer::class);
            $this->company_id = Company::query()->value('id');
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:16'],
            'company_id' => ['required', 'integer', 'exists:companies,id'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        $editing = (bool) $this->customer;

        $customer = $this->customer ?? new Customer;
        $customer->fill($this->only(['first_name', 'last_name', 'email', 'phone', 'company_id']));
        $customer->save();

        session()->flash('success', $editing ? __('Customer updated.') : __('Customer created.'));

        $this->redirectRoute('admin.customers.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.customers.form', [
            'editing' => (bool) $this->customer,
            'companies' => Company::orderBy('name')->pluck('name', 'id'),
        ]);
    }
}
