<?php

namespace App\Notifications\Admin;

use App\Models\ContactInquire;

class NewContactInquiry extends AdminNotification
{
    public function __construct(public ContactInquire $inquiry) {}

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'inquiry',
            'title' => __('New contact inquiry'),
            'message' => $this->inquiry->name ?? $this->inquiry->email ?? '',
            'route' => 'admin.contact-inquiries.show',
            'param' => $this->inquiry->id,
        ];
    }
}
