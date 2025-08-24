<?php

namespace App\Enums;

/**
 * AddressType cast definition.
 *
 * @var int
 */
enum PaymentMethod: int
{
    case CashOrCard = 1;
    case BankTransfer = 2;
    case OnlinePayment = 3;
    case PaymentTerminal = 4;

    public static function forSelect(): array
    {
        return array_column(self::cases(), 'name', 'id');
    }

    public static function getPaymentMethodListWithLabels(): array
    {
        return [
            self::CashOrCard->value => __('order.payment_method.cash_or_card'),
            self::BankTransfer->value => __('order.payment_method.bank_transfer'),
            self::OnlinePayment->value => __('order.payment_method.online_payment'),
            self::PaymentTerminal->value => __('order.payment_method.payment_terminal'),
        ];
    }
}
