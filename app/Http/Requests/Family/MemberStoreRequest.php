<?php

namespace App\Http\Requests\Family;

use App\Models\Family;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Family::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'gender_id' => ['required', Rule::exists('genders', 'id')],
            'birth_date' => ['required', 'date'],
            'height' => ['required', 'integer'],
            'weight' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'gender_id' => $this->get('gender')['id'],
        ]);
    }
}
