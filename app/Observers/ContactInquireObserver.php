<?php

namespace App\Observers;

use App\Models\ContactInquire;
use App\Notifications\Admin\NewContactInquiry;
use App\Support\AdminAudience;
use Illuminate\Support\Facades\Notification;

class ContactInquireObserver
{
    public function created(ContactInquire $inquiry): void
    {
        Notification::send(AdminAudience::for('inquiry'), new NewContactInquiry($inquiry));
    }
}
