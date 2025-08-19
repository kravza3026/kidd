<?php

namespace App\Enums;

/**
 * AddressType cast definition.
 *
 * @var int
 */
enum AddressType: int {
        case Private = 1;
        case Commercial = 2;
        case Shipping = 3;
    case Billing = 4;

    public static function getAddressTypesListWithLabels(): array
    {
        return [
            self::Private->value => 'Private',
            self::Commercial->value => 'Commercial',
            self::Shipping->value => 'Shipping',
            self::Billing->value => 'Billing',
        ];
    }

}
