<?php

namespace App\Livewire\Admin\Vacancies;

use App\Models\Vacancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
class Show extends Component
{
    public Vacancy $vacancy;

    public function mount(Vacancy $vacancy): void
    {
        $this->authorize('view', $vacancy);
        $this->vacancy = $vacancy->loadCount('applications')->load('company', 'location');
    }

    public function render(): View
    {
        return view('livewire.admin.vacancies.show');
    }
}
