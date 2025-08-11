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
            'vacancy_id' => ['required', 'exists:vacancies,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'first_name' => ['required', 'string', 'min:1', 'max:40'],
            'last_name' => ['required', 'string', 'min:1', 'max:40'],
            'phone' => ['required', (new Phone)->country(['MD'])->type('mobile')],
            'email' => ['required', 'email', 'min:1', 'max:150'],
            'cv' => ['required_without:cv_url', 'missing_if:cv_url,any', 'file', 'mimes:pdf,doc,docx,img,jpeg,png'],
            'cv_url' => ['required_without:cv', 'sometimes'],
            'terms' => ['accepted'],
        ];
    }


    protected function prepareForValidation(): void
    {
        // Inject the current vacancy (ID) into the request from the route parameter
        $this->merge([
            'vacancy_id' => $this->route()->parameter('vacancy')->id,
        ]);

        // Inject the current authenticated user into the request if its available
        $this->merge([
            'user_id' => auth()->check() ? $this->user()->id : null,
        ]);

        // Normalize phone number by removing spaces, parentheses, dashes, and dots
        if ($this->has('phone')) {
            $this->merge([
                'phone' => Str::replace([' ','(', ')', '-', '.'], '', $this->input('phone')),
            ]);
        }

    }

    protected function passedValidation(): void
    {
//        $this->dd($this->replace(['user_id' => 111]), $this->validatedExcept(['cv_url', 'cv', 'terms']),$this->validated(), $this->data());
    }

}
