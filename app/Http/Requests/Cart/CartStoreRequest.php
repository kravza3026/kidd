<?php

namespace App\Http\Requests\Cart;

use App\Models\ProductVariant;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CartStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Cap the quantity at the variant's available stock (falls back to a sane max when the
        // variant can't be resolved — the exists rule reports that separately).
        $stock = ProductVariant::whereKey($this->input('variant_id'))->value('quantity');
        $maxQuantity = max(1, (int) ($stock ?? 99));

        return [
            'variant_id' => ['required', 'integer', 'exists:product_variants,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$maxQuantity],
        ];
    }
}
