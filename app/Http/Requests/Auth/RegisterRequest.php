<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\Rules\Phone;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                Rule::unique(User::class, 'phone'),
                (new Phone)->country(['MD', 'RO'])->type('mobile')],

            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'min:8'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Remove spaces and parentheses from phone number
        $phone = $this->input('phone');
        $phone = Str::trim($phone, ' ');
        $phone = Str::replace(' ', '', $phone);
        $phone = Str::replace('(', '', $phone);
        $phone = Str::replace(')', '', $phone);

        $this->merge([
            'phone' => $phone,
        ]);
    }


    public function messages(): array
    {
        return [
            'phone.unique' => __('validation.custom.phone.unique', locale: 'ro'),
            'phone.required' => __('validation.custom.phone.required', locale: 'ro'),
        ];
    }

}
