@extends('store.checkout.layouts.checkout')

@section('checkout-form')
    <div class="mb-8">
        <h1 class="text-[32px] font-bold">{{ __('checkout.review.title') }}</h1>
        <p class="text-sm text-charcoal/60 mt-2">{{ __('checkout.review.subtitle') }}</p>
    </div>

    <div class="space-y-6">
        <!-- Shipping Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="flex justify-between items-start mb-4">
                <h2 class="text-lg font-bold">{{ __('checkout.review.shipping_info') }}</h2>
                <a href="{{ route('checkout.previous', ['step' => 'contact']) }}" class="text-sm text-olive hover:underline">
                    {{ __('checkout.shipping.edit') }}
                </a>
            </div>
            <div class="text-sm space-y-1">
                <p>{{ $checkoutData['shipping_address'] }}</p>
                <p>{{ $checkoutData['shipping_city'] }}, {{ $checkoutData['shipping_postcode'] }}</p>
                <p>{{ $checkoutData['shipping_country'] }}</p>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="flex justify-between items-start mb-4">
                <h2 class="text-lg font-bold">{{ __('checkout.review.contact_info') }}</h2>
                <a href="{{ route('checkout.previous', ['step' => 'payment']) }}" class="text-sm text-olive hover:underline">
                    {{ __('checkout.contact.edit') }}
                </a>
            </div>
            <div class="text-sm space-y-1">
                <p>{{ $checkoutData['contact_first_name'] }} {{ $checkoutData['contact_last_name'] }}</p>
                <p>{{ $checkoutData['contact_email'] }}</p>
                <p>{{ $checkoutData['contact_phone'] }}</p>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="flex justify-between items-start mb-4">
                <h2 class="text-lg font-bold">{{ __('checkout.review.payment_info') }}</h2>
                <a href="{{ route('checkout.previous', ['step' => 'review']) }}" class="text-sm text-olive hover:underline">
                    {{ __('checkout.payment.edit') }}
                </a>
            </div>
            <div class="text-sm space-y-1">
                <p>{{ __('checkout.review.payment_method') }}: {{ ucfirst($checkoutData['payment_method']) }}</p>
                @if($checkoutData['payment_method'] === 'card')
                    <p>{{ __('checkout.review.card_ending') }} {{ substr($checkoutData['card_number'], -4) }}</p>
                @endif
            </div>
        </div>

        <form action="{{ route('checkout.complete') }}" method="POST">
            @csrf
            <div class="flex justify-between items-center pt-8">
                <a href="{{ route('checkout.previous', ['step' => 'review']) }}"
                   class="flex items-center gap-2 text-sm text-charcoal/60 hover:text-charcoal">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Payment
                </a>
                <button type="submit"
                        class="bg-olive text-white px-6 py-3 rounded-xl hover:bg-olive-dark focus:outline-none focus:ring-2 focus:ring-olive focus:ring-offset-2">
                    {{ __('checkout.place_order') }}
                </button>
            </div>
        </form>
    </div>
@endsection
