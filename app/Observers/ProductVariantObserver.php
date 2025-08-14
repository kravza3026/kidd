<?php

namespace App\Observers;

use App\Models\ProductVariant;

class ProductVariantObserver
{
    /**
     * Handle the ProductVariant "saved" event.
     */
    public function saved(ProductVariant $productVariant): void
    {
        // Get the parent product
        $product = $productVariant->product;

        if ($product) {
            // Check if any variants have a discount
            $hasDiscount = $product->variants()
                ->where(function ($query) {
                    $query->whereNotNull('discount_amount')
                          ->orWhereNotNull('discount_display');
                })
                ->exists();

            // Update the product's has_discount field if it's different
            if ($product->has_discount !== $hasDiscount) {
                $product->has_discount = $hasDiscount;
                $product->save();
            }
        }
    }
}
