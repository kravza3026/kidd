<?php

namespace App\Http\Requests\Family;

use App\Models\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreFamilyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
//            'user_id' => ['required', 'exists:users'],
            'gender_id' => ['required', 'exists:genders'],
            'name' => ['required'],
            'birth_date' => ['date'],
            'height' => ['integer'],
            'weight' => ['integer'],
            'notes' => ['nullable'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id,
        ]);
    }
}
