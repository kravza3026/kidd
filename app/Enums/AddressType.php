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
        case Billing = 3;
        case Shipping = 4;

    public static function getAddressTypesListWithLabels(): array
    {
        return [
            self::Private->value => 'Private',
            self::Commercial->value => 'Commercial',
            self::Billing->value => 'Billing',
            self::Shipping->value => 'Shipping',
        ];
    }

}

