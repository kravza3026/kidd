<?php

namespace App\Livewire\Admin\Audit;

use App\Livewire\Concerns\WithDataTable;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

#[Layout('layouts.admin.admin')]
#[Title('Audit log')]
class Index extends Component
{
    use WithDataTable;

    #[Url(history: true)]
    public string $event = '';

    public function mount(): void
    {
        $this->authorize('audit.viewAny');
    }

    public function updatedEvent(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $activities = Activity::query()
            ->with(['causer', 'subject'])
            ->when($this->event !== '', fn ($q) => $q->where('event', $this->event))
            ->when($this->search !== '', function ($q) {
                $term = '%'.$this->search.'%';
                $q->where(fn ($q) => $q->where('description', 'ilike', $term)
                    ->orWhere('log_name', 'ilike', $term)
                    ->orWhere('subject_type', 'ilike', $term));
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.audit.index', [
            'activities' => $activities,
            'events' => ['created' => __('Created'), 'updated' => __('Updated'), 'deleted' => __('Deleted')],
        ]);
    }
}
