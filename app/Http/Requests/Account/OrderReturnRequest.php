<?php

namespace App\Http\Requests\Account;

use App\Enums\ReturnReason;
use App\Models\Order;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderReturnRequest extends FormRequest
{
    /**
     * Only the owner of a delivered order may request a return for it.
     */
    public function authorize(): bool
    {
        $order = $this->route('order');

        return $order instanceof Order
            && $order->user?->id === $this->user()?->id
            && $order->status->isReturnable();
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $order = $this->route('order');
        $itemIds = $order instanceof Order ? $order->items->pluck('id')->all() : [];

        return [
            'items' => ['required', 'array', 'min:1'],
            'items.*' => ['integer', Rule::in($itemIds)],
            'reason' => ['required', Rule::enum(ReturnReason::class)],
            'comment' => ['nullable', 'string', 'max:1000'],
            'images' => ['nullable', 'array', 'max:5'],
            'images.*' => ['image', 'mimes:png,jpg,jpeg', 'max:5120'],
        ];
    }
}
