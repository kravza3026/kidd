<?php

namespace App\Coupons;

use LaraCart;
use LukePOLO\LaraCart\Contracts\CouponContract;
use LukePOLO\LaraCart\Exceptions\CouponException;
use LukePOLO\LaraCart\Traits\CouponTrait;

class FreeDeliveryCoupon implements CouponContract
{
    use CouponTrait;

    public function __construct($code, $value, array $options = [])
    {
        $this->code = $code;
        $this->value = $value;

        // this allows you to access your variables via $this->$option
        $this->setOptions($options);
    }

    /**
     * Gets the discount amount
     *
     * @param  bool  $throwErrors  this allows us to capture errors in our code if we wish,
     *                             that way we can spit out why the coupon has failed
     * @return string
     *
     * @throws CouponException
     */
    public function discount($throwErrors = false)
    {
        // $this->minAmount was passed to the $options when constructing the coupon class
        $this->checkMinAmount(config('laracart.free_delivery_after') * 100, $throwErrors);

        return $this->value;
    }

    /**
     * Displays the type of value it is for the user
     *
     * @return mixed
     */
    public function displayValue($locale = null, $internationalFormat = null)
    {
        return LaraCart::formatMoney($this->value, $locale, $internationalFormat);
    }
}
