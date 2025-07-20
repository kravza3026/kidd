<?php

namespace App\Exceptions;

use Money\Currency;

final class CurrencyMissmatchException extends \Exception
{
    /**
     * Creates an exception from Currency objects.
     *
     * @param Currency $localCurrency
     * @param Currency $newCurrency
     *
     * @return CurrencyMissmatchException
     */
    public static function createFromCurrencies(Currency $localCurrency, Currency $newCurrency): self
    {
        $message = sprintf(
            'Currencies do not match: %s != %s',
            $localCurrency->getCode(),
            $newCurrency->getCode()
        );

        return new self($message);
    }
}
