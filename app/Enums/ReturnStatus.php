<?php

namespace App\Enums;

/**
 * Lifecycle of a customer return request, managed by staff in the admin inbox.
 */
enum ReturnStatus: int
{
    case Pending = 1;
    case Approved = 2;
    case Rejected = 3;
    case Completed = 4;

    public function label(): string
    {
        return match ($this) {
            self::Pending => __('order.return.statuses.pending'),
            self::Approved => __('order.return.statuses.approved'),
            self::Rejected => __('order.return.statuses.rejected'),
            self::Completed => __('order.return.statuses.completed'),
        };
    }

    /**
     * Badge colour used by the admin status-badge component.
     */
    public function color(): string
    {
        return match ($this) {
            self::Pending => 'yellow',
            self::Approved => 'blue',
            self::Rejected => 'red',
            self::Completed => 'green',
        };
    }
}
