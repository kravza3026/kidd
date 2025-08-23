<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;
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
            'contact_first_name' => ['required', 'string', 'min:2', 'max:50'],
            'contact_last_name' => ['required', 'string', 'min:2', 'max:50'],
            'contact_email' => [
                'required', 'max:200', Rule::email()
//                    ->validateMxRecord()
                    ->rfcCompliant(strict: true),
            ],
            'contact_phone' => ['required', (new Phone)->international()->country(['MD'])->type('mobile')],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'contact_first_name' => __('validation.attributes.first_name'),
            'contact_last_name' => __('validation.attributes.last_name'),
            'contact_email' => __('validation.attributes.email'),
            'contact_phone' => __('validation.attributes.phone'),
        ];
    }
}
