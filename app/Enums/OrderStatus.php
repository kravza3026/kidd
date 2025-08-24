<?php

namespace App\Enums;

/**
 * AddressType cast definition.
 *
 * @var int
 */
enum OrderStatus: int
{
    case Pending = 1;
    case Processing = 2;
    case Processed = 3;
    case OutForDelivery = 4;
    case Delivered = 5;
    case Returned = 6;
    case Canceled = 7;

    public static function getOrderStatusListWithLabels(): array
    {
        return [
            self::Pending->value => 'Pending',
            self::Processing->value => 'Processing',
            self::Processed->value => 'Processed',
            self::OutForDelivery->value => 'Out for delivery',
            self::Delivered->value => 'Delivered',
            self::Returned->value => 'Returned',
            self::Canceled->value => 'Cancelled',
        ];
    }
}
