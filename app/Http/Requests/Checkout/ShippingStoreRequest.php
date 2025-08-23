<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class ShippingStoreRequest extends FormRequest
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
            'shipping_method' => ['required', 'in:regular,gift,express'],
            'shipping_region' => ['required', 'exists:regions,id'],
            'shipping_city' => ['required', 'exists:cities,id'],
            'shipping_street_name' => ['required', 'string'],
            'shipping_building' => ['required', 'string'],
            'shipping_postal_code' => ['required', 'string', 'regex:/^(MD\-)\d{4}$/'],
            'shipping_apartment' => ['nullable', 'string'],
            'shipping_entrance' => ['nullable', 'string'],
            'shipping_floor' => ['nullable', 'string'],
            'shipping_intercom' => ['nullable', 'string'],
            'saved_address' => ['nullable', 'string'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'shipping_region' => __('validation.attributes.region'),
            'shipping_city' => __('validation.attributes.city'),
            'shipping_street_name' => __('validation.attributes.street_name'),
            'shipping_building' => __('validation.attributes.building'),
            'shipping_postal_code' => __('validation.attributes.postal_code'),
            'shipping_apartment' => __('validation.attributes.apartment'),
            'shipping_entrance' => __('validation.attributes.entrance'),
            'shipping_floor' => __('validation.attributes.floor'),
            'shipping_intercom' => __('validation.attributes.intercom'),
        ];
    }
}
