<?php

namespace App\Http\Requests\Address;

use App\Enums\AddressType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddressStoreRequest extends FormRequest
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
            'label' => [
                'required',
                'string',
                'min:5'
            ],
            'is_default' => [
                'boolean'
            ],
            'address_type' => [
                'required',
                Rule::enum(AddressType::class),
            ],
            'region_id' => [
                'required',
                'exists:regions,id'
            ],
            'city_id' => [
                'required',
                'exists:cities,id'
            ],
            'street_name' => [
                'required',
                'string',
                'max:70',
            ],
            'building' => [
                'required',
                'string',
                'max:10',
            ],
            'entrance' => [
                'nullable',
                'alpha_num'
            ],
            'floor' => [
                'nullable',
                'numeric',
                'max:15',
            ],
            'apartment' => [
                'nullable',
                'string',
                'max:5',
            ],
            'intercom' => [
                'nullable',
                'string',
                'max:5',
            ],
            'postal_code' => [
                'required',
                'string',
                'regex:/^(MD\-)\d{4}$/',
            ],
        ];
    }
}
