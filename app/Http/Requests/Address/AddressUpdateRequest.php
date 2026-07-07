<?php

namespace App\Http\Requests\Address;

use App\Enums\AddressType;
use App\Models\Address;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddressUpdateRequest extends FormRequest
{
    /**
     * Only the owner of the (polymorphic) address may update it. Checked before validation
     * so a non-owner is rejected without leaking the rules.
     */
    public function authorize(): bool
    {
        $address = $this->route('address');
        $user = $this->user();

        return $address instanceof Address
            && $user !== null
            && $address->addressable_type === $user->getMorphClass()
            && (int) $address->addressable_id === (int) $user->getKey();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'label' => [
                'required',
                'string',
                'min:5',
            ],
            'is_default' => [
                'boolean',
            ],
            'address_type' => [
                'required',
                Rule::enum(AddressType::class),
            ],
            'region_id' => [
                'required',
                'exists:regions,id',
            ],
            'city_id' => [
                'required',
                'exists:cities,id',
            ],
            'street_name' => [
                'required',
                'string',
            ],
            'building' => [
                'required',
                'string',
                'max:10',
            ],
            'entrance' => [
                'nullable',
                'alpha_num',
            ],
            'floor' => [
                'nullable',
                'numeric',
            ],
            'apartment' => [
                'nullable',
                'string',
            ],
            'intercom' => [
                'nullable',
                'string',
            ],
            'postal_code' => [
                'required',
                'string',
                'regex:/^(MD\-)\d{4}$/',
            ],
        ];
    }
}
