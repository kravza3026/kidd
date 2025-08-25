<?php

namespace App\Casts;

use App\Exceptions\CurrencyMissmatchException;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Money\Currency;
use Money\Money;

class MoneyCast implements CastsAttributes
{
    /**
     * Name of the Currency source attribute.
     */
    protected string $sourceCurrencyCode;

    /**
     * Create a new cast class instance.
     *
     * @return void
     */
    public function __construct(string $sourceCurrencyCode)
    {
        $this->sourceCurrencyCode = $sourceCurrencyCode;
    }

    /**
     * Transform the attribute from the underlying model values.
     *
     * @return Money|string
     *
     * @throws InvalidArgumentException
     */
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {

        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            throw new InvalidArgumentException('The stored '.Money::class.' value should be integer(ish)');
        }

        $currencyCode = $this->sourceCurrencyCode ?? 'MDL';

        if (! is_string($currencyCode) || (! $currencyCode)) {
            throw new InvalidArgumentException('The stored '.Currency::class.' value should be not-empty-sting');
        }

        //        return new Money($value, new Currency($currencyCode))->getAmount();
        $money = new Money($value, new Currency($currencyCode));

        return (int) $money->getAmount();

        //        $money = new Money($value, new Currency($currencyCode));
        //        $currencies = new ISOCurrencies();
        //
        //        $numberFormatter = new NumberFormatter('ro_RO', NumberFormatter::CURRENCY);
        //        $numberFormatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
        //
        //        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
        //
        //        return $moneyFormatter->format($money); // outputs 1.00 MDL

    }

    /**
     * Transform the attribute to its underlying model values.
     *
     * @return array<string,string>
     *
     * @throws CurrencyMissmatchException
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        if (! $value instanceof Money) {
            throw new InvalidArgumentException('The given value is not an '.Money::class.' instance');
        }

        $currencyCode = $this->sourceCurrencyAttributeName ?? 'MDL';

        if (! is_string($currencyCode) || (! $currencyCode)) {
            throw new InvalidArgumentException('The stored '.Currency::class.' value should be not-empty-sting');
        }

        $currency = new Currency($currencyCode);

        if (! $currency->equals($value->getCurrency())) {
            throw CurrencyMissmatchException::createFromCurrencies($currency, $value->getCurrency());
        }

        return [$key => $value->getAmount()];
    }
}

// $data = Http::get(sprintf('https://www.bnm.md/'.app()->getLocale().'/official_exchange_rates?get_xml=1&date=%s', '27.02.2024'));
// $data = $data->body();
// $xml = new SimpleXMLElement($data);
// $rates = array();
// foreach ($xml->Valute as $xmlRate) {
//    $rates[(string) $xmlRate->CharCode] = $xmlRate;
// }

// dd($rates);

//        $exchange = new ReversedCurrenciesExchange(new FixedExchange([
//            'EUR' => [
//                'USD' => "1.25",
//                'MDL' => "19.6100",
//                "RUB" => "0.015",
//            ],
//            'USD' => [
//                'MDL' => "17.5710",
//            ],
//        ]));
//
//        $currencies = new ISOCurrencies();
//        $converter = new Converter($currencies, $exchange);
//
//        $rub = Money::RUB(5432100);
//        $mdl100 = Money::MDL(5432100);
//        $mdl_to_usd = $converter->convert($mdl100, new Currency('USD'));
//        $mdl_to_eur = $converter->convert($mdl100, new Currency('EUR'));
//
//        $usd100 = Money::USD(100);
//        $usd_to_mdl = $converter->convert($usd100, new Currency('MDL'));
//
//        $eur100 = Money::EUR(100);
//        $eur_to_mdl = $converter->convert($eur100, new Currency('MDL'));
//
//        var_dump($mdl100->jsonSerialize(), $mdl_to_usd->jsonSerialize(), $mdl_to_eur->jsonSerialize());
//        echo sprintf("%.2f\n", $mdl_to_usd->getAmount());
//        var_dump($usd100->jsonSerialize(), $usd_to_mdl->jsonSerialize());
//        echo sprintf("%.2f\n", $usd_to_mdl->getAmount());
//        var_dump($eur100->jsonSerialize(), $eur_to_mdl->jsonSerialize());
//        echo sprintf("%.2f\n", $eur_to_mdl->getAmount());
//        var_dump('----------------------');
//
//        $numberFormatterRU = new \NumberFormatter('ru_RU', \NumberFormatter::CURRENCY);
//        $moneyFormatterRU = new IntlMoneyFormatter($numberFormatterRU, $currencies);
//
//        $numberFormatterMD = new \NumberFormatter('ro_MD', \NumberFormatter::CURRENCY);
//        $numberFormatterMD->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
//        $numberFormatterMD->setTextAttribute(\NumberFormatter::CURRENCY_CODE, 'Lei');
//        $moneyFormatterMD = new IntlMoneyFormatter($numberFormatterMD, $currencies);
//        echo sprintf("MD ----- %s\n<br>", $moneyFormatterMD->format($mdl100)); // outputs 1.000,00
//
//        echo sprintf("RU  ----- %s\n<br>", $moneyFormatterRU->format($rub)); // outputs 1.000,00
//        $fmt = new \NumberFormatter( 'ro_MD', \NumberFormatter::CURRENCY);
//        $fmt->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
//        echo sprintf("MD ----- %s\n<br>", $fmt->formatCurrency(54321, "MDL"));
