<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
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
        return [
            'first_name' => ['required', 'string', 'max:70'],
            'last_name' => ['required', 'string', 'max:70'],
            'phone' => ['required', Rule::unique(User::class, 'phone')->ignore($this->user()->id), (new Phone)->country(['MD', 'RO'])->type('mobile')],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:70', Rule::unique(User::class)->ignore($this->user()->id)],
            'password' => ['exclude_if:password,null', 'min:6', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.unique' => 'This phone number is already taken.',
            'phone.required' => 'Phone number is required.',
        ];
    }

}
