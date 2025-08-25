<?php

namespace App\Enums;

/**
 * PaymentMethod cast definition.
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

    public function label(): string
    {
        return match ($this) {
            self::CashOrCard => __('checkout.payment.form.payment_methods.cash_card_at_delivery'),
            self::BankTransfer => __('checkout.payment.form.payment_methods.bank_transfer'),
            self::OnlinePayment => __('checkout.payment.form.payment_methods.card_online'),
            self::PaymentTerminal => __('checkout.payment.form.payment_methods.terminal'),
        };
    }

    public function labelWithDesc(): string
    {
        return match ($this) {
            self::CashOrCard => __('checkout.payment.form.payment_methods.cash_card_at_delivery').' '.__('checkout.payment.form.payment_methods.cash_card_at_delivery_desc'),
            self::BankTransfer => __('checkout.payment.form.payment_methods.bank_transfer').' '.__('checkout.payment.form.payment_methods.bank_transfer_desc'),
            self::OnlinePayment => __('checkout.payment.form.payment_methods.card_online').' '.__('checkout.payment.form.payment_methods.card_online_desc'),
            self::PaymentTerminal => __('checkout.payment.form.payment_methods.terminal').' '.__('checkout.payment.form.payment_methods.terminal_desc'),
        };
    }
}
