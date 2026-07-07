<?php

namespace App\Livewire\Admin\Addresses;

use App\Enums\AddressType;
use App\Models\Address;
use App\Models\City;
use App\Models\Region;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Livewire\Component;

/**
 * Reusable address manager embedded on any addressable record (customer, order, user, …).
 * Lists the record's polymorphic addresses and supports add/edit/delete and per-type default.
 */
class Manager extends Component
{
    /** @var class-string<Model> */
    public string $addressableType;

    public int $addressableId;

    public bool $showForm = false;

    public ?int $editingId = null;

    // Form fields.
    public string $label = '';

    public int $address_type = 3; // Shipping

    public ?int $region_id = null;

    public ?int $city_id = null;

    public string $contact_first_name = '';

    public string $contact_last_name = '';

    public string $contact_phone = '';

    public string $contact_email = '';

    public string $street_name = '';

    public string $building = '';

    public ?string $entrance = null;

    public ?string $floor = null;

    public ?string $apartment = null;

    public ?string $intercom = null;

    public string $postal_code = '';

    public bool $is_default = false;

    public function mount(string $addressableType, int $addressableId): void
    {
        $this->addressableType = $addressableType;
        $this->addressableId = $addressableId;

        $this->authorize('update', $this->addressable());
    }

    public function new(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $address = $this->addresses()->findOrFail($id);

        $this->editingId = $address->id;
        $this->fill($address->only([
            'label', 'address_type', 'region_id', 'city_id', 'contact_first_name', 'contact_last_name',
            'contact_phone', 'contact_email', 'street_name', 'building', 'entrance', 'floor',
            'apartment', 'intercom', 'postal_code', 'is_default',
        ]));
        $this->address_type = $address->address_type->value;
        $this->showForm = true;
    }

    public function save(): void
    {
        $this->authorize('update', $this->addressable());
        $data = $this->validate();

        $address = $this->editingId
            ? $this->addresses()->findOrFail($this->editingId)
            : $this->addressable()->addresses()->make();

        $address->fill($data);
        $address->address_type = AddressType::from($this->address_type);
        $this->addressable()->addresses()->save($address);

        if ($this->is_default) {
            $this->clearOtherDefaults($address);
        }

        $this->showForm = false;
        $this->resetForm();
        $this->dispatch('toast', type: 'success', message: __('Address saved.'));
    }

    public function delete(int $id): void
    {
        $this->authorize('update', $this->addressable());
        $this->addresses()->findOrFail($id)->delete();
        $this->dispatch('toast', type: 'success', message: __('Address removed.'));
    }

    public function makeDefault(int $id): void
    {
        $this->authorize('update', $this->addressable());
        $address = $this->addresses()->findOrFail($id);
        $address->update(['is_default' => true]);
        $this->clearOtherDefaults($address);
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'label' => ['required', 'string', 'min:3', 'max:100'],
            'address_type' => ['required', Rule::enum(AddressType::class)],
            'region_id' => ['required', 'integer', 'exists:regions,id'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'contact_first_name' => ['nullable', 'string', 'max:255'],
            'contact_last_name' => ['nullable', 'string', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'street_name' => ['required', 'string', 'max:70'],
            'building' => ['required', 'string', 'max:10'],
            'entrance' => ['nullable', 'string', 'max:10'],
            'floor' => ['nullable', 'string', 'max:15'],
            'apartment' => ['nullable', 'string', 'max:10'],
            'intercom' => ['nullable', 'string', 'max:10'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'is_default' => ['boolean'],
        ];
    }

    protected function addressable(): Model
    {
        return $this->addressableType::findOrFail($this->addressableId);
    }

    protected function addresses()
    {
        return $this->addressable()->addresses();
    }

    protected function clearOtherDefaults(Address $address): void
    {
        $this->addressable()->addresses()
            ->where('id', '!=', $address->id)
            ->where('address_type', $address->address_type)
            ->update(['is_default' => false]);
    }

    protected function resetForm(): void
    {
        $this->reset([
            'editingId', 'label', 'region_id', 'city_id', 'contact_first_name', 'contact_last_name',
            'contact_phone', 'contact_email', 'street_name', 'building', 'entrance', 'floor',
            'apartment', 'intercom', 'postal_code', 'is_default',
        ]);
        $this->address_type = AddressType::Shipping->value;
    }

    public function render(): View
    {
        $locale = app()->getLocale();

        return view('livewire.admin.addresses.manager', [
            'addresses' => $this->addresses()->with(['region', 'city'])->orderByDesc('is_default')->get(),
            'regions' => Region::orderBy('name->'.$locale)->get()->mapWithKeys(fn ($r) => [$r->id => $r->getTranslation('name', $locale)]),
            'cities' => $this->region_id
                ? City::where('region_id', $this->region_id)->orderBy('name->'.$locale)->get()->mapWithKeys(fn ($c) => [$c->id => $c->getTranslation('name', $locale)])
                : collect(),
            'types' => collect(AddressType::cases())->mapWithKeys(fn ($t) => [$t->value => $t->name])->all(),
        ]);
    }
}
