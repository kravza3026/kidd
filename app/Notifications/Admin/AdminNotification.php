<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

/**
 * Base for admin-facing notifications. Stored in the database for the bell/center and
 * broadcast on each recipient's private channel for live updates. Queued, so a downed
 * Reverb (or slow broadcast) never blocks the action that triggered it.
 */
abstract class AdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * The stored / broadcast payload. Subclasses provide the concrete data.
     *
     * @return array<string, mixed>
     */
    abstract public function toArray(object $notifiable): array;

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }
}
