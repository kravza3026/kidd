<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\Rules\Phone;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        if ($this->has('section') && $this->get('section') === 'profile') {

            $this->errorBag = 'profile';

            return [
                'first_name' => ['required', 'string', 'max:70'],
                'last_name' => ['required', 'string', 'max:70'],
                'phone' => ['required', Rule::unique(User::class, 'phone')->ignore($this->user()->id), (new Phone)->country(['MD', 'RO'])->type('mobile')],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:70', Rule::unique(User::class)->ignore($this->user()->id)],
                'password' => ['exclude_if:password,null', 'min:6', 'confirmed'],
            ];

        }

        if ($this->has('section') && $this->get('section') === 'marketing') {

            $this->errorBag = 'marketing';

            return [
                'newsletter' => ['boolean'],
                'new_order_to_email' => ['boolean'],
                'new_order_to_sms' => ['boolean'],
                'order_status_sms' => ['boolean'],
                'order_status_email' => ['boolean'],
            ];

        }

        return [
            'section' => [
                'required', 'string', Rule::in([
                        'profile', 'marketing'
                    ])
            ]
        ];

    }

    protected function prepareForValidation(): void
    {
        if($this->has('section') && $this->get('section') === 'marketing') {
            $this->merge([
                'newsletter' => (bool) $this->input('newsletter', false),
                'new_order_to_email' => (bool) $this->input('new_order_to_email', false),
                'new_order_to_sms' => (bool) $this->input('new_order_to_sms', false),
                'order_status_sms' => (bool) $this->input('order_status_sms', false),
                'order_status_email' => (bool) $this->input('order_status_email', false),
            ]);
        }

        // Normalize phone number by removing spaces, parentheses, dashes, and dots
        if ($this->has('phone')) {
            $this->merge([
                'phone' => Str::replace([' ','(', ')', '-', '.'], '', $this->input('phone')),
            ]);
        }

    }

    public function messages(): array
    {
        return [
            'phone.unique' => 'This phone number is already taken.',
            'phone.required' => 'Phone number is required.',
        ];
    }

}
