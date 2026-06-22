<?php

namespace App\Livewire\Admin\ContactInquiries;

use App\Livewire\Concerns\WithDataTable;
use App\Models\ContactInquire;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Inquiries')]
class Index extends Component
{
    use WithDataTable;

    public function mount(): void
    {
        $this->authorize('viewAny', ContactInquire::class);
    }

    public function delete(int $id): void
    {
        $inquiry = ContactInquire::findOrFail($id);
        $this->authorize('delete', $inquiry);
        $inquiry->delete();

        $this->dispatch('toast', type: 'success', message: __('Inquiry deleted.'));
    }

    public function render(): View
    {
        $sortable = ['id', 'first_name', 'email', 'created_at'];
        $sort = in_array($this->sortField, $sortable, true) ? $this->sortField : 'id';

        $inquiries = ContactInquire::query()
            ->when($this->search !== '', function ($query) {
                $term = '%'.$this->search.'%';
                $query->where(fn ($q) => $q->where('first_name', 'ilike', $term)
                    ->orWhere('last_name', 'ilike', $term)
                    ->orWhere('email', 'ilike', $term)
                    ->orWhere('message', 'ilike', $term));
            })
            ->orderBy($sort, $this->safeSortDirection())
            ->paginate($this->perPage);

        return view('livewire.admin.contact-inquiries.index', compact('inquiries'));
    }
}
