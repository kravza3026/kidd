<?php

namespace App\Livewire\Admin\Settings;

use App\Settings\StoreSettings;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.admin')]
#[Title('Settings')]
class Edit extends Component
{
    public ?string $facebook_url = null;

    public ?string $instagram_url = null;

    public ?string $messenger_url = null;

    public ?string $youtube_url = null;

    public ?string $tiktok_url = null;

    public ?string $contact_phone = null;

    public ?string $contact_email = null;

    public function mount(StoreSettings $settings): void
    {
        $this->authorize('setting.viewAny');

        $this->facebook_url = $settings->facebook_url;
        $this->instagram_url = $settings->instagram_url;
        $this->messenger_url = $settings->messenger_url;
        $this->youtube_url = $settings->youtube_url;
        $this->tiktok_url = $settings->tiktok_url;
        $this->contact_phone = $settings->contact_phone;
        $this->contact_email = $settings->contact_email;
    }

    public function save(StoreSettings $settings): void
    {
        $this->authorize('setting.update');

        $data = $this->validate([
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'messenger_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'tiktok_url' => ['nullable', 'url', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_email' => ['nullable', 'email', 'max:255'],
        ]);

        $settings->fill($data);
        $settings->save();

        $this->dispatch('toast', type: 'success', message: __('Settings saved.'));
    }

    public function render(): View
    {
        return view('livewire.admin.settings.edit');
    }
}
