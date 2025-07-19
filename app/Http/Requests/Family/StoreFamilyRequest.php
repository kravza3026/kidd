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
//            'gender_id' => ['required', 'exists:genders'],
            'name' => ['required'],
            'birth_date' => ['nullable', 'date'],
            'height' => ['nullable', 'integer'],
            'weight' => ['nullable', 'integer'],
            'notes' => ['nullable'],
        ];
    }
//
//    public function __invoke()
//    {
//        return [
//            'user_id' => auth()->user()->id,
//            'gender_id' => Gender::GIRL,
//            'name' => 'Baby Girl',
//            'birth_date' => Carbon::now()->subMonths(rand(1, 9)),
//            'height' => 55,
//            'weight' => 3445,
//            'notes' => 'Test note...',
//        ];
//    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id,
            'gender_id' => Gender::GIRL,
        ]);
    }
}
