<?php

namespace App\Livewire\Admin\VacancyApplications;

use App\Models\VacancyApplication;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
class Show extends Component
{
    public VacancyApplication $application;

    public function mount(VacancyApplication $application): void
    {
        $this->authorize('view', $application);
        $this->application = $application->load('vacancy');
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->application);
        $this->application->delete();

        session()->flash('success', __('Application deleted.'));
        $this->redirectRoute('admin.vacancy-applications.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.vacancy-applications.show');
    }
}
