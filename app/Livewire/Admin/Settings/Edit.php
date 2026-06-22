<?php

namespace App\Livewire\Admin\Settings;

use App\Settings\NotificationSettings;
use App\Settings\StoreSettings;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
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

    public bool $notify_new_order = true;

    public bool $notify_new_inquiry = true;

    public bool $notify_new_application = true;

    public bool $notify_low_stock = true;

    public function mount(StoreSettings $settings, NotificationSettings $notifications): void
    {
        $this->authorize('setting.viewAny');

        $this->facebook_url = $settings->facebook_url;
        $this->instagram_url = $settings->instagram_url;
        $this->messenger_url = $settings->messenger_url;
        $this->youtube_url = $settings->youtube_url;
        $this->tiktok_url = $settings->tiktok_url;
        $this->contact_phone = $settings->contact_phone;
        $this->contact_email = $settings->contact_email;

        $this->notify_new_order = $notifications->notify_new_order;
        $this->notify_new_inquiry = $notifications->notify_new_inquiry;
        $this->notify_new_application = $notifications->notify_new_application;
        $this->notify_low_stock = $notifications->notify_low_stock;
    }

    public function save(StoreSettings $settings, NotificationSettings $notifications): void
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
            'notify_new_order' => ['boolean'],
            'notify_new_inquiry' => ['boolean'],
            'notify_new_application' => ['boolean'],
            'notify_low_stock' => ['boolean'],
        ]);

        $settings->fill(Arr::only($data, [
            'facebook_url', 'instagram_url', 'messenger_url', 'youtube_url', 'tiktok_url', 'contact_phone', 'contact_email',
        ]));
        $settings->save();

        $notifications->fill(Arr::only($data, [
            'notify_new_order', 'notify_new_inquiry', 'notify_new_application', 'notify_low_stock',
        ]));
        $notifications->save();

        $this->dispatch('toast', type: 'success', message: __('Settings saved.'));
    }

    public function render(): View
    {
        return view('livewire.admin.settings.edit');
    }
}
