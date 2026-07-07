<?php

namespace App\Observers;

use App\Models\OrderReturn;
use App\Notifications\Admin\NewReturnRequest;
use App\Support\AdminAudience;
use Illuminate\Support\Facades\Notification;

class OrderReturnObserver
{
    public function created(OrderReturn $return): void
    {
        Notification::send(AdminAudience::for('return'), new NewReturnRequest($return));
    }
}
