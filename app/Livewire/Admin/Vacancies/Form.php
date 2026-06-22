<?php

namespace App\Livewire\Admin\Vacancies;

use App\Models\Company;
use App\Models\Location;
use App\Models\Vacancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
class Form extends Component
{
    public ?Vacancy $vacancy = null;

    /** @var array<string, array<string, string>> */
    public array $fields = [];

    public bool $remote = false;

    public ?int $company_id = null;

    public ?int $location_id = null;

    public ?string $notes = null;

    /**
     * Translatable text fields managed by this form.
     *
     * @var list<string>
     */
    public const TRANSLATABLE = ['title', 'summary', 'responsibilities', 'requirements', 'extra'];

    public function mount(?Vacancy $vacancy = null): void
    {
        $locales = array_keys(config('app.locales'));
        foreach (self::TRANSLATABLE as $field) {
            $this->fields[$field] = array_fill_keys($locales, '');
        }

        if ($vacancy?->exists) {
            $this->authorize('update', $vacancy);
            $this->vacancy = $vacancy;
            foreach (self::TRANSLATABLE as $field) {
                $this->fields[$field] = array_merge($this->fields[$field], $vacancy->getTranslations($field));
            }
            $this->remote = (bool) $vacancy->remote;
            $this->company_id = $vacancy->company_id;
            $this->location_id = $vacancy->location_id;
            $this->notes = $vacancy->notes;
        } else {
            $this->authorize('create', Vacancy::class);
            $this->company_id = Company::query()->value('id');
            $this->location_id = Location::query()->value('id');
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        $rules = [
            'remote' => ['boolean'],
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'location_id' => ['required', 'integer', 'exists:locations,id'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ];

        foreach (array_keys(config('app.locales')) as $locale) {
            $rules["fields.title.{$locale}"] = ['required', 'string', 'max:255'];
            foreach (['summary', 'responsibilities', 'requirements', 'extra'] as $field) {
                $rules["fields.{$field}.{$locale}"] = ['nullable', 'string', 'max:8000'];
            }
        }

        return $rules;
    }

    public function save(): void
    {
        $this->validate();
        $editing = (bool) $this->vacancy;

        $vacancy = $this->vacancy ?? new Vacancy;
        foreach (self::TRANSLATABLE as $field) {
            $vacancy->{$field} = $this->fields[$field];
        }
        $vacancy->remote = $this->remote;
        $vacancy->company_id = $this->company_id;
        $vacancy->location_id = $this->location_id;
        $vacancy->notes = $this->notes;
        $vacancy->save();

        session()->flash('success', $editing ? __('Vacancy updated.') : __('Vacancy created.'));

        $this->redirectRoute('admin.vacancies.index', navigate: true);
    }

    public function render(): View
    {
        $locale = app()->getLocale();

        return view('livewire.admin.vacancies.form', [
            'editing' => (bool) $this->vacancy,
            'companies' => Company::orderBy('name')->pluck('name', 'id'),
            'locations' => Location::all()->mapWithKeys(fn ($l) => [$l->id => $l->getTranslation('name', $locale)]),
        ]);
    }
}
