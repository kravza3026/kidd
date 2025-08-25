<?php

namespace App\Enums;

/**
 * ShippingMethod cast definition.
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

    public function label(): string
    {
        return match ($this) {
            ShippingMethod::Regular => __('checkout.shipping.form.shipping_methods.regular.title'),
            ShippingMethod::Gift => __('checkout.shipping.form.shipping_methods.gift.title'),
            ShippingMethod::Express => __('checkout.shipping.form.shipping_methods.express.title'),
        };
    }
}
