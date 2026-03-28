@extends('store.checkout.layouts.checkout')
@php
    $progressWidth = '100%';
    $step = 'Review';
    $shipping_region = $regions->where('id', $checkoutData['shipping_region'])->first();
    $shipping_city = $shipping_region->cities->where('id', $checkoutData['shipping_city'])->first();

    $billing_region = $regions->where('id', $checkoutData['billing_region'])->first();
    $billing_city = $billing_region->cities->where('id', $checkoutData['billing_city'])->first();
@endphp

@section('checkout-form')
    <div class="space-y-6">
        <!-- Shipping Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="mb-4 flex items-start justify-between">
                <h2 class="text-lg font-bold">{{ __('checkout.steps.shipping') }}</h2>
                <a
                    href="{{ route('checkout.previous', ['step' => 'contact']) }}"
                    class="text-olive border-olive hover:bg-olive rounded-full border bg-white p-1.5 text-sm duration-300 hover:text-white"
                >
                    <svg
                        class="size-4.5"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                    >
                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path
                            d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"
                        />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 gap-y-6 text-sm xl:grid-cols-4">
                <div class="col-span-2">
                    <p class="opacity-60">{{ __('checkout.shipping.form.shipping_method') }}:</p>
                    <p class="text-base font-bold">
                        {{ \App\Enums\ShippingMethod::tryFrom($checkoutData['shipping_method'])->label() }}
                    </p>
                </div>
                <div>
                    <p class="opacity-60">{{ __('checkout.shipping.form.shipping_region') }}:</p>
                    <p class="text-base font-bold">{{ $shipping_region->name ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">{{ __('checkout.shipping.form.shipping_city') }}:</p>
                    <p class="text-base font-bold">
                        {{ $shipping_region->cities->where('id', $checkoutData['shipping_city'])->first()->name ?? '--' }}
                    </p>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <p class="opacity-60">{{ __('checkout.shipping.form.shipping_street_name') }}.</p>
                    <p class="text-base font-bold">
                        {{ $checkoutData['shipping_street_name'] ?? '--' }}
                        {{ $checkoutData['shipping_building'] ?? '' }}
                    </p>
                </div>
                <div>
                    <p class="opacity-60">{{ __('checkout.shipping.form.shipping_postal_code') }}:</p>
                    <p class="text-base font-bold">{{ $checkoutData['shipping_postal_code'] ?? '--' }}</p>
                </div>
                @if ($checkoutData['shipping_apartment'])
                    <div>
                        <p class="opacity-60">{{ __('checkout.shipping.form.shipping_apartment') }}:</p>
                        <p class="text-base font-bold">{{ $checkoutData['shipping_apartment'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">{{ __('checkout.shipping.form.shipping_entrance') }}:</p>
                        <p class="text-base font-bold">{{ $checkoutData['shipping_entrance'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">{{ __('checkout.shipping.form.shipping_floor') }}:</p>
                        <p class="text-base font-bold">{{ $checkoutData['shipping_floor'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">{{ __('checkout.shipping.form.shipping_intercom') }}:</p>
                        <p class="text-base font-bold">{{ $checkoutData['shipping_intercom'] ?? '--' }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="mb-4 flex items-start justify-between">
                <h2 class="text-lg font-bold">{{ __('checkout.steps.contacts') }}</h2>
                <a
                    href="{{ route('checkout.previous', ['step' => 'payment']) }}"
                    class="text-olive border-olive hover:bg-olive rounded-2xl border bg-white p-1.5 text-sm duration-300 hover:text-white"
                >
                    <svg
                        class="size-4.5"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                    >
                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path
                            d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"
                        />
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-1 gap-y-6 text-sm sm:grid-cols-2 xl:grid-cols-4">
                <div>
                    <p class="opacity-60">{{ __('checkout.contact.form.first_name') }}:</p>
                    <p class="text-base font-bold">{{ $checkoutData['contact_first_name'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">{{ __('checkout.contact.form.last_name') }}:</p>
                    <p class="text-base font-bold">{{ $checkoutData['contact_last_name'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">{{ __('checkout.contact.form.email') }}:</p>
                    <p class="text-base font-bold">{{ $checkoutData['contact_email'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">{{ __('checkout.contact.form.phone') }}:</p>
                    <p class="text-base font-bold">{{ $checkoutData['contact_phone'] ?? '--' }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="mb-4 flex items-start justify-between">
                <h2 class="text-lg font-bold">{{ __('checkout.steps.payment') }}</h2>
                <a
                    href="{{ route('checkout.previous', ['step' => 'review']) }}"
                    class="text-olive border-olive hover:bg-olive rounded-2xl border bg-white p-1.5 text-sm duration-300 hover:text-white"
                >
                    <svg
                        class="size-4.5"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                    >
                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path
                            d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"
                        />
                    </svg>
                </a>
            </div>
            <div class="space-y-1 text-sm">
                <div class="pb-4">
                    <p class="pb-1 opacity-60">{{ __('checkout.payment.form.payment_method') }}:</p>
                    <p class="text-base font-bold">
                        {{ \App\Enums\PaymentMethod::tryFrom($checkoutData['payment_method'])->labelWithDesc() }}
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-y-6 text-sm xl:grid-cols-4">
                    <div>
                        <p class="opacity-60">{{ __('checkout.payment.form.billing_region') }}:</p>
                        <p class="text-base font-bold">{{ $billing_region->name ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">{{ __('checkout.payment.form.billing_city') }}:</p>
                        <p class="text-base font-bold">
                            {{ $billing_region->cities->where('id', $checkoutData['billing_city'])->first()->name ?? '--' }}
                        </p>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <p class="opacity-60">{{ __('checkout.payment.form.billing_street_name') }}.</p>
                        <p class="text-base font-bold">
                            {{ $checkoutData['billing_street_name'] ?? '--' }}
                            {{ $checkoutData['billing_building'] ?? '--' }}
                        </p>
                    </div>
                    <div>
                        <p class="opacity-60">{{ __('checkout.payment.form.billing_postal_code') }}:</p>
                        <p class="text-base font-bold">{{ $checkoutData['billing_postal_code'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">{{ __('checkout.payment.form.billing_apartment') }}:</p>
                        <p class="text-base font-bold">{{ $checkoutData['billing_apartment'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">{{ __('checkout.payment.form.billing_entrance') }}:</p>
                        <p class="text-base font-bold">{{ $checkoutData['billing_entrance'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">{{ __('checkout.payment.form.billing_floor') }}:</p>
                        <p class="text-base font-bold">{{ $checkoutData['billing_floor'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">{{ __('checkout.payment.form.billing_intercom') }}:</p>
                        <p class="text-base font-bold">{{ $checkoutData['billing_intercom'] ?? '--' }}</p>
                    </div>
                    @if ($checkoutData['payment_method'] === 'card')
                        <div>
                            <p class="opacity-60">Card Ending:</p>
                            <p class="text-base font-bold">{{ substr($checkoutData['card_number'], -4) }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <form action="{{ route('checkout.complete') }}" method="POST" id="checkoutForm">
            @csrf
            <div class="flex items-center justify-between pt-8">
                <x-ui.button
                    as="button"
                    class="!mt-0 w-full px-15 !py-3 sm:w-auto"
                    right_icon="false"
                    id="{{ auth()->check() ? 'placeOrder' : 'loginButton2' }}"
                    type="{{ auth()->check() ? 'submit' : 'button' }}"
                >
                    {{ __('checkout.complete_checkout') }}
                </x-ui.button>
            </div>
        </form>
    </div>
@endsection

@push('head')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById('loginButton2')) {
                document.getElementById('loginButton2').addEventListener('click', function (e) {
                    Swal.fire({
                        html: @json(view('store.checkout.modal')->render()),
                        showConfirmButton: false,
                        width: '64em',
                        showCloseButton: false,
                        customClass: {
                            popup: 'my-swal-rounded',
                        },
                        didOpen: () => {
                            const closeButtons = document.querySelectorAll('.closeSignIn');
                            closeButtons.forEach((btn) => {
                                btn.addEventListener('click', () => {
                                    Swal.close();
                                });
                            });
                        },
                    });
                });
            }
        });
    </script>
@endpush
