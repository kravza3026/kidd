<?php

namespace App\Services;

use App\Models\Region;
use Illuminate\Support\Facades\Cache;
use LukePOLO\LaraCart\Facades\LaraCart;

class CheckoutViewDataService
{
    /**
     * Get view data for a specific checkout step.
     */
    public function getStepViewData(string $step, array $checkoutData = []): array
    {
        return $this->getCommonViewData($step, $checkoutData);
    }

    /**
     * Get common view data for checkout steps.
     */
    public function getCommonViewData(string $currentStep, array $checkoutData = []): array
    {
        return array_merge([
            'currentStep' => $currentStep,
            'checkoutData' => $checkoutData,
            'regions' => $this->getRegions(),
        ], $this->getCartData());
    }

    /**
     * Get regions with cities from cache.
     */
    public function getRegions(): \Illuminate\Database\Eloquent\Collection
    {
        return Cache::flexible('regions', [600, 1800], function () {
            return Region::with('cities')
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();
        });
    }

    /**
     * Get cart data for checkout views.
     */
    public function getCartData(): array
    {
        return [
            'items' => LaraCart::getItems(),
            'fees' => LaraCart::getFees(),
            'coupons' => LaraCart::getCoupons(),
            'count' => LaraCart::count($withItemQty = false),
            'sub_total' => LaraCart::subTotal($formatted = false, $withDiscount = true) / 100,
            'fee_sub_total' => LaraCart::feeSubTotal($formatted = false, $withDiscount = true) / 100,
            'total_discount' => LaraCart::discountTotal($formatted = false) / 100,
            'total' => LaraCart::total($formatted = false, true) / 100,
        ];
    }

    /**
     * Get view data for the review step.
     */
    public function getReviewViewData(array $checkoutData = []): array
    {
        return $this->getCommonViewData('review', $checkoutData);
    }

    /**
     * Get the view name for a checkout step.
     */
    public function getStepView(string $step): string
    {
        $views = [
            'shipping' => 'store.checkout.shipping',
            'contact' => 'store.checkout.contact',
            'payment' => 'store.checkout.payment',
            'review' => 'store.checkout.review',
        ];

        return $views[$step] ?? $views['shipping'];
    }

    /**
     * Check if cart is empty.
     */
    public function isCartEmpty(): bool
    {
        return LaraCart::count() === 0;
    }

    /**
     * Get cart summary for display.
     */
    public function getCartSummary(): array
    {
        return [
            'item_count' => LaraCart::count($withItemQty = false),
            'total_items' => LaraCart::count($withItemQty = true),
            'subtotal' => LaraCart::subTotal($formatted = false, $withDiscount = true) / 100,
            'total' => LaraCart::total($formatted = false, true) / 100,
        ];
    }
}
