<?php

namespace App\Observers;

use App\Models\Order;
use App\Notifications\Admin\NewOrderPlaced;
use App\Support\AdminAudience;
use Illuminate\Support\Facades\Notification;

class OrderObserver
{
    public function created(Order $order): void
    {
        Notification::send(AdminAudience::for('order'), new NewOrderPlaced($order));
    }
}
