<?php

namespace App\Support;

use App\Models\ProductVariant;
use Illuminate\Support\Str;

/**
 * Generates and validates 1D EAN-13 barcodes for product variants.
 *
 * EAN prefixes 20–29 are reserved for in-store / internal numbering, so generated
 * codes are safe to mint without a GS1 company prefix. A code is 12 data digits plus
 * one modulo-10 check digit.
 */
class Barcode
{
    private const INTERNAL_PREFIX = '20';

    /**
     * Mint a fresh EAN-13 value not already used by any variant.
     */
    public static function generateUniqueEan13(): string
    {
        do {
            $barcode = self::randomEan13();
        } while (ProductVariant::query()->where('barcode', $barcode)->exists());

        return $barcode;
    }

    /**
     * Build a random EAN-13: internal prefix + 10 random digits + check digit.
     */
    public static function randomEan13(): string
    {
        $base = self::INTERNAL_PREFIX.str_pad((string) random_int(0, 9_999_999_999), 10, '0', STR_PAD_LEFT);

        return $base.self::checkDigit($base);
    }

    /**
     * Compute the EAN-13 modulo-10 check digit for a 12-digit base.
     */
    public static function checkDigit(string $twelveDigits): string
    {
        $sum = 0;
        foreach (str_split($twelveDigits) as $i => $digit) {
            $sum += (int) $digit * ($i % 2 === 0 ? 1 : 3);
        }

        return (string) ((10 - ($sum % 10)) % 10);
    }

    /**
     * Validate that a string is a structurally correct EAN-13.
     */
    public static function isValidEan13(string $value): bool
    {
        if (! Str::of($value)->isMatch('/^\d{13}$/')) {
            return false;
        }

        return self::checkDigit(substr($value, 0, 12)) === substr($value, 12, 1);
    }
}
