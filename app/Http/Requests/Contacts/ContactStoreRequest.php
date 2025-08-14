<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;
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
            'user_id' => 'nullable', 'integer', 'exists:users,id',
            'first_name' => 'required', 'string', 'min:3', 'max:50',
            'last_name' => 'required', 'string', 'min:3', 'max:50',
            'email' => 'required', 'email', 'max:150',
            'phone' => ['required', (new Phone)->country(['MD'])->type('mobile')],
            'message' => 'required', 'string', 'min:100', 'max:500',
            'consent' => 'accepted', 'boolean',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->user()?->id,
        ]);
    }
}
