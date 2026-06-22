<?php

namespace App\Enums;

/**
 * Kinds of stock-ledger entries. Each movement stores a signed quantity; this enum
 * documents intent and the conventional direction of that quantity.
 */
enum StockMovementType: string
{
    case Receipt = 'receipt';       // goods received into a warehouse (+)
    case Sale = 'sale';             // sold / shipped out (−)
    case Transfer = 'transfer';     // moved between warehouses (− at source, + at destination)
    case Adjustment = 'adjustment'; // manual correction (±)
    case Return = 'return';         // customer return back into stock (+)

    /** @return array<string, string> */
    public static function forSelect(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }

    public function label(): string
    {
        return match ($this) {
            self::Receipt => __('Receipt'),
            self::Sale => __('Sale'),
            self::Transfer => __('Transfer'),
            self::Adjustment => __('Adjustment'),
            self::Return => __('Return'),
        };
    }
}
