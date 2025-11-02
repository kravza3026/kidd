<?php

namespace App\Enums;

/**
 * AddressType cast definition.
 *
 * @var int
 */
enum OrderStatus: int
{
    case New = 0;
    case Pending = 1;
    case Processing = 2;
    case Processed = 3;
    case OutForDelivery = 4;
    case Delivered = 5;
    case Refunded = 6;
    case Returned = 7;
    case Canceled = 8;
    case Completed = 9;
    case Expired = 10;
    case Failed = 11;
    case Shipped = 12;

    public static function forSelect(): array
    {
        return array_column(self::cases(), 'name', 'id');
    }

    public static function labelWithDesc(): array
    {
        return [
            self::New->value => __('order_statuses.new'),
            self::Pending->value => __('order_statuses.pending'),
            self::Processing->value => __('order_statuses.processing'),
            self::Processed->value => __('order_statuses.processed'),
            self::OutForDelivery->value => __('order_statuses.out_for_delivery'),
            self::Delivered->value => __('order_statuses.delivered'),
            self::Returned->value => __('order_statuses.returned'),
            self::Refunded->value => __('order_statuses.refunded'),
            self::Canceled->value => __('order_statuses.canceled'),
            self::Completed->value => __('order_statuses.completed'),
            self::Expired->value => __('order_statuses.expired'),
            self::Failed->value => __('order_statuses.failed'),
            self::Shipped->value => __('order_statuses.shipped'),
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::New => __('order_statuses.new'),
            self::Pending => __('order_statuses.pending'),
            self::Processing => __('order_statuses.processing'),
            self::Processed => __('order_statuses.processed'),
            self::OutForDelivery => __('order_statuses.out_for_delivery'),
            self::Delivered => __('order_statuses.delivered'),
            self::Refunded => __('order_statuses.returned'),
            self::Returned => __('order_statuses.refunded'),
            self::Canceled => __('order_statuses.canceled'),
            self::Completed => __('order_statuses.completed'),
            self::Expired => __('order_statuses.expired'),
            self::Failed => __('order_statuses.failed'),
            self::Shipped => __('order_statuses.shipped'),
        };
    }
}
