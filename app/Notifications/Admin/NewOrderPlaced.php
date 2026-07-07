<?php

namespace App\Notifications\Admin;

use App\Models\Order;

class NewOrderPlaced extends AdminNotification
{
    public function __construct(public Order $order) {}

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'order',
            'title' => __('New order'),
            'message' => $this->order->order_number ?? ('#'.$this->order->id),
            'route' => 'admin.orders.show',
            'param' => $this->order->id,
        ];
    }
}
