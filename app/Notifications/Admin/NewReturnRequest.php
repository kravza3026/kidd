<?php

namespace App\Notifications\Admin;

use App\Models\OrderReturn;

class NewReturnRequest extends AdminNotification
{
    public function __construct(public OrderReturn $return) {}

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'return',
            'title' => __('New return request'),
            'message' => $this->return->order->order_number ?? ('#'.$this->return->order_id),
            'route' => 'admin.order-returns.show',
            'param' => $this->return->id,
        ];
    }
}
