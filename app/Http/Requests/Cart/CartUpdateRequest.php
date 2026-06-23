<?php

namespace App\Http\Requests\Cart;

use App\Models\ProductVariant;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CartUpdateRequest extends FormRequest
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
        $stock = ProductVariant::whereKey($this->input('variant_id'))->value('quantity');
        $maxQuantity = max(1, (int) ($stock ?? 99));

        return [
            'variant_id' => ['required', 'integer', 'exists:product_variants,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$maxQuantity],
        ];
    }
}
