@extends('store.checkout.layouts.checkout')

@section('checkout-form')
    <div class="mb-8">
        <h1 class="text-[32px] font-bold">{{ __('checkout.review.title') }}</h1>
        <p class="text-charcoal/60 mt-2 text-sm">{{ __('checkout.review.subtitle') }}</p>
    </div>

    <div class="space-y-6">
        <!-- Shipping Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="mb-4 flex items-start justify-between">
                <h2 class="text-lg font-bold">{{ __('checkout.review.shipping_info') }}</h2>
                <a
                    href="{{ route('checkout.previous', ['step' => 'contact']) }}"
                    class="text-olive text-sm hover:underline"
                >
                    {{ __('checkout.shipping.edit') }}
                </a>
            </div>
            <div class="space-y-1 text-sm">
                <p>
                    Region: {{ $checkoutData['shipping_region'] }} City: {{ $checkoutData['shipping_city'] }} Str.
                    {{ $checkoutData['shipping_street_name'] }} {{ $checkoutData['shipping_building'] }} Postal Code:
                    {{ $checkoutData['shipping_postal_code'] }} Apt: {{ $checkoutData['shipping_apartment'] }}
                    Entrance: {{ $checkoutData['shipping_entrance'] }} Floor: {{ $checkoutData['shipping_floor'] }}
                    Intercom: {{ $checkoutData['shipping_intercom'] }}
                </p>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="mb-4 flex items-start justify-between">
                <h2 class="text-lg font-bold">{{ __('checkout.review.contact_info') }}</h2>
                <a
                    href="{{ route('checkout.previous', ['step' => 'payment']) }}"
                    class="text-olive text-sm hover:underline"
                >
                    {{ __('checkout.contact.edit') }}
                </a>
            </div>
            <div class="space-y-1 text-sm">
                <p>{{ $checkoutData['contact_first_name'] }} {{ $checkoutData['contact_last_name'] }}</p>
                <p>{{ $checkoutData['contact_email'] }}</p>
                <p>{{ $checkoutData['contact_phone'] }}</p>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="mb-4 flex items-start justify-between">
                <h2 class="text-lg font-bold">{{ __('checkout.review.payment_info') }}</h2>
                <a
                    href="{{ route('checkout.previous', ['step' => 'review']) }}"
                    class="text-olive text-sm hover:underline"
                >
                    {{ __('checkout.payment.edit') }}
                </a>
            </div>
            <div class="space-y-1 text-sm">
                <p>{{ __('checkout.review.payment_method') }}: {{ ucfirst($checkoutData['payment_method']) }}</p>
            @if ($checkoutData['payment_method'] === 'card')
                    <p>{{ __('checkout.review.card_ending') }} {{ substr($checkoutData['card_number'], -4) }}</p>
                @endif
            </div>
        </div>

        <form action="{{ route('checkout.complete') }}" method="POST">
            @csrf
            <div class="flex items-center justify-between pt-8">
                <a
                    href="{{ route('checkout.previous', ['step' => 'review']) }}"
                    class="text-charcoal/60 hover:text-charcoal flex items-center gap-2 text-sm"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Payment
                </a>
                <button
                    type="submit"
                    class="bg-olive hover:bg-olive-dark focus:ring-olive rounded-xl px-6 py-3 text-white focus:ring-2 focus:ring-offset-2 focus:outline-none"
                >
                    {{ __('checkout.place_order') }}
                </button>
            </div>
        </form>
    </div>
@endsection
