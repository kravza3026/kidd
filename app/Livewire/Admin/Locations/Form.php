<?php

namespace App\Livewire\Admin\Locations;

use App\Models\Location;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
class Form extends Component
{
    public ?Location $location = null;

    /** @var array<string, string> */
    public array $name = [];

    public int $type = Location::TYPE_WAREHOUSE;

    public function mount(?Location $location = null): void
    {
        $this->name = array_fill_keys(array_keys(config('app.locales')), '');

        if ($location?->exists) {
            $this->authorize('update', $location);
            $this->location = $location;
            $this->name = array_merge($this->name, $location->getTranslations('name'));
            $this->type = (int) $location->type;
        } else {
            $this->authorize('create', Location::class);
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        $rules = ['type' => ['required', 'integer', 'in:1,2']];

        foreach (array_keys(config('app.locales')) as $locale) {
            $rules["name.{$locale}"] = ['required', 'string', 'max:255'];
        }

        return $rules;
    }

    public function save(): void
    {
        $this->validate();
        $editing = (bool) $this->location;

        $location = $this->location ?? new Location;
        $location->name = $this->name;
        $location->type = $this->type;
        $location->save();

        session()->flash('success', $editing ? __('Location updated.') : __('Location created.'));

        $this->redirectRoute('admin.locations.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.locations.form', [
            'editing' => (bool) $this->location,
            'types' => [Location::TYPE_WAREHOUSE => __('Warehouse'), Location::TYPE_STORE => __('Store')],
        ]);
    }
}
