<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\Rules\Phone;

class ContactStoreRequest extends FormRequest
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
            'contact_first_name' => ['required', 'string', 'min:3', 'max:50'],
            'contact_last_name' => ['required', 'string', 'min:1', 'max:50'],
            'contact_email' => [
                'required', 'max:200', Rule::email()
//                    ->validateMxRecord()
                    ->rfcCompliant(strict: true),
            ],
            'contact_phone' => ['required', (new Phone)->international()->country(['MD'])->type('mobile')],
        ];
    }

    protected function prepareForValidation(): void
    {
        // Normalize phone number by removing spaces, parentheses, dashes, and dots
        if ($this->has('contact_phone')) {
            $this->merge([
                'contact_phone' => Str::replace([' ', '(', ')', '-', '.'], '', $this->input('contact_phone')),
            ]);
        }

    }
}
