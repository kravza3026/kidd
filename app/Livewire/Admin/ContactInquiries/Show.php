<?php

namespace App\Livewire\Admin\ContactInquiries;

use App\Models\ContactInquire;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
class Show extends Component
{
    public ContactInquire $inquiry;

    public function mount(ContactInquire $inquiry): void
    {
        $this->authorize('view', $inquiry);
        $this->inquiry = $inquiry->load('user');
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->inquiry);
        $this->inquiry->delete();

        session()->flash('success', __('Inquiry deleted.'));
        $this->redirectRoute('admin.contact-inquiries.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.contact-inquiries.show');
    }
}
