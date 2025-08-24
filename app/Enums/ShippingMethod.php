<?php

namespace App\Enums;

/**
 * AddressType cast definition.
 *
 * @var int
 */
enum ShippingMethod: int
{
    case Regular = 1;
    case Gift = 2;
    case Express = 3;

    public static function forSelect(): array
    {
        return array_column(self::cases(), 'name', 'id');
    }
}
