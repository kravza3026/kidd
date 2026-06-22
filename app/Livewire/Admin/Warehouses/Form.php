<?php

namespace App\Livewire\Admin\Warehouses;

use App\Models\Warehouse;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
class Form extends Component
{
    public ?Warehouse $warehouse = null;

    /** @var array<string, string> */
    public array $name = [];

    public string $code = '';

    public function mount(?Warehouse $warehouse = null): void
    {
        $this->name = array_fill_keys(array_keys(config('app.locales')), '');

        if ($warehouse?->exists) {
            $this->authorize('update', $warehouse);
            $this->warehouse = $warehouse;
            $this->name = array_merge($this->name, $warehouse->getTranslations('name'));
            $this->code = (string) $warehouse->code;
        } else {
            $this->authorize('create', Warehouse::class);
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        $rules = [
            'code' => ['required', 'string', 'max:3', Rule::unique('warehouses', 'code')->ignore($this->warehouse?->id)],
        ];

        foreach (array_keys(config('app.locales')) as $locale) {
            $rules["name.{$locale}"] = ['required', 'string', 'max:255'];
        }

        return $rules;
    }

    public function save(): void
    {
        $this->validate();
        $editing = (bool) $this->warehouse;

        $warehouse = $this->warehouse ?? new Warehouse;
        $warehouse->name = $this->name;
        $warehouse->code = strtoupper($this->code);
        $warehouse->save();

        session()->flash('success', $editing ? __('Warehouse updated.') : __('Warehouse created.'));

        $this->redirectRoute('admin.warehouses.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.warehouses.form', ['editing' => (bool) $this->warehouse]);
    }
}
