<?php

namespace App\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * Header notification bell: unread count + recent list, with mark-as-read. Refreshes on a
 * poll and instantly when a broadcast notification arrives (admin.js dispatches the event).
 */
class NotificationBell extends Component
{
    #[On('notification-received')]
    public function refresh(): void
    {
        // Re-render to pick up the newly stored notification.
    }

    public function markRead(string $id): void
    {
        auth()->user()?->notifications()->whereKey($id)->first()?->markAsRead();
    }

    public function markAllRead(): void
    {
        auth()->user()?->unreadNotifications->markAsRead();
    }

    public function render(): View
    {
        $user = auth()->user();

        return view('livewire.admin.notification-bell', [
            'unread' => $user ? $user->unreadNotifications()->count() : 0,
            'items' => $user ? $user->notifications()->latest()->limit(10)->get() : collect(),
        ]);
    }
}
