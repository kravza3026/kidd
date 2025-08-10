<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\Rules\Phone;

class VacancyApplicationStoreRequest extends FormRequest
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
            'vacancy' => ['required', 'exists:vacancies,id'],
            'first_name' => ['required', 'string', 'min:1', 'max:30'],
            'last_name' => ['required', 'string', 'min:1', 'max:30'],
            'phone' => ['required', (new Phone)->country(['MD'])->type('mobile')],
            'email' => ['required', 'string', 'min:1', 'max:30'],
            'cv' => ['required_without:cv_url', 'nullable', 'file', 'mimes:pdf,doc,docx,img,jpeg,png'],
            'cv_url' => ['required_without:cv', 'nullable', 'active_url'],
            'terms' => 'accepted',
        ];
    }


    protected function prepareForValidation(): void
    {
        // Normalize phone number by removing spaces, parentheses, dashes, and dots
        if ($this->has('phone')) {
            $this->merge([
                'phone' => Str::replace([' ','(', ')', '-', '.'], '', $this->input('phone')),
            ]);
        }

    }

}
