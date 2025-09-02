@extends('store.checkout.layouts.checkout')
@php
    $progressWidth = '100%';
    $step = 'Review'
@endphp
@section('checkout-form')
    <div class="space-y-6">
        <!-- Shipping Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="mb-4 flex items-start justify-between">
                <h2 class="text-lg font-bold">{{ __('checkout.steps.shipping') }}</h2>
                <a
                    href="{{ route('checkout.previous', ['step' => 'contact']) }}"
                    class="text-olive hover:text-white border border-olive bg-white p-1.5 hover:bg-olive rounded-full duration-300 text-sm"
                >
                    <svg class="size-4.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path
                            d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>

                </a>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-6 text-sm">
                <div>
                    <p class="opacity-60">Region:</p>
                    <p class="font-bold text-base">{{ $checkoutData['shipping_region'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">City:</p>
                    <p class="font-bold text-base">{{ $checkoutData['shipping_city'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">Str.</p>
                    <p class="font-bold text-base">{{ $checkoutData['shipping_street_name'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">Postal Code:</p>
                    <p class="font-bold text-base">{{ $checkoutData['shipping_postal_code'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">Apt:</p>
                    <p class="font-bold text-base">{{ $checkoutData['shipping_apartment'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">Entrance:</p>
                    <p class="font-bold text-base">{{ $checkoutData['shipping_entrance'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">Floor:</p>
                    <p class="font-bold text-base">{{ $checkoutData['shipping_floor'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">Intercom:</p>
                    <p class="font-bold text-base">{{ $checkoutData['shipping_intercom'] ?? '--' }}</p>
                </div>

            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="mb-4 flex items-start justify-between">
                <h2 class="text-lg font-bold">{{ __('checkout.steps.contacts') }}</h2>
                <a
                    href="{{ route('checkout.previous', ['step' => 'payment']) }}"
                    class="text-olive hover:text-white border border-olive bg-white p-1.5 hover:bg-olive rounded-2xl duration-300 text-sm"
                >
                    <svg class="size-4.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path
                            d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>

                </a>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-6 text-sm">
                <div>
                    <p class="opacity-60">First Name:</p>
                    <p class="font-bold text-base">{{ $checkoutData['contact_first_name'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">Second Name:</p>
                    <p class="font-bold text-base">{{ $checkoutData['contact_last_name'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">Email:</p>
                    <p class="font-bold text-base">{{ $checkoutData['contact_email'] ?? '--' }}</p>
                </div>
                <div>
                    <p class="opacity-60">Phone number:</p>
                    <p class="font-bold text-base">{{ $checkoutData['contact_phone'] ?? '--' }}</p>
                </div>
            </div>

        </div>

        <!-- Payment Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="mb-4 flex items-start justify-between">
                <h2 class="text-lg font-bold">{{ __('checkout.steps.payment') }}</h2>
                <a
                    href="{{ route('checkout.previous', ['step' => 'review']) }}"
                    class="text-olive hover:text-white border border-olive bg-white p-1.5 hover:bg-olive rounded-2xl duration-300 text-sm"
                >
                    <svg class="size-4.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path
                            d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>

                </a>
            </div>
            <div class="space-y-1 text-sm">
                <p class="py-2">
                   <span class="font-bold">Payment Method:</span>
                    {{ \App\Enums\PaymentMethod::tryFrom($checkoutData['payment_method'])->name }}
                </p>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-6 text-sm">
                    <div>
                        <p class="opacity-60">Region:</p>
                        <p class="font-bold text-base">{{ $checkoutData['billing_region'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">City:</p>
                        <p class="font-bold text-base">{{ $checkoutData['billing_city'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">Str.</p>
                        <p class="font-bold text-base">{{ $checkoutData['billing_street_name'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">Postal Code:</p>
                        <p class="font-bold text-base">{{ $checkoutData['billing_postal_code'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">Apt:</p>
                        <p class="font-bold text-base">{{ $checkoutData['billing_apartment'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">Entrance:</p>
                        <p class="font-bold text-base">{{ $checkoutData['billing_entrance'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">Floor:</p>
                        <p class="font-bold text-base">{{ $checkoutData['billing_floor'] ?? '--' }}</p>
                    </div>
                    <div>
                        <p class="opacity-60">Intercom:</p>
                        <p class="font-bold text-base">{{ $checkoutData['billing_intercom'] ?? '--' }}</p>
                    </div>
                    @if ($checkoutData['payment_method'] === 'card')
                        <div>
                            <p class="opacity-60">Card Ending:</p>
                            <p class="font-bold text-base">{{ substr($checkoutData['card_number'], -4) }}</p>
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
                    class="px-15 !py-3 !mt-0"
                    right_icon="false"
                    id="{{ auth()->check() ? 'placeOrder' : 'loginButton2' }}"
                    type="{{ auth()->check() ? 'submit' : 'button' }}"

                    >
                    Approve Order
                </x-ui.button>
            </div>
        </form>
    </div>
@endsection
@push('head')
<script>
    document.addEventListener('DOMContentLoaded', function () {
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
    })
</script>
@endpush
