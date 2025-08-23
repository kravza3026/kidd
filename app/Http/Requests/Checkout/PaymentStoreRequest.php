<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_method' => ['required', 'in:card,cash'],
            'card_number' => ['required_if:payment_method,card', 'string', 'digits:16'],
            'card_expiry' => ['required_if:payment_method,card', 'string', 'regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/'],
            'card_cvv' => ['required_if:payment_method,card', 'string', 'digits:3'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        // TODO - add translations
        return [
            'payment_method' => 'payment method',
            'card_number' => 'card number',
            'card_expiry' => 'card expiry date',
            'card_cvv' => 'CVV code',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        // TODO - add translations
        return [
            'card_expiry.regex' => 'The card expiry date must be in MM/YY format.',
            'card_number.digits' => 'The card number must be exactly 16 digits.',
            'card_cvv.digits' => 'The CVV must be exactly 3 digits.',
        ];
    }
}
