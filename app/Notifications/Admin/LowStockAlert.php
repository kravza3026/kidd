<?php

namespace App\Notifications\Admin;

use App\Models\ProductVariant;

class LowStockAlert extends AdminNotification
{
    public function __construct(public ProductVariant $variant) {}

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'stock',
            'title' => __('Low stock'),
            'message' => ($this->variant->sku ?? '#'.$this->variant->id).' · '.$this->variant->quantity,
            'route' => 'admin.inventory.show',
            'param' => $this->variant->id,
        ];
    }
}
