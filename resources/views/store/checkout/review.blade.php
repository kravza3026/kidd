@extends('store.checkout.layouts.checkout')

@section('checkout-form')
    <div class="mb-8">
        <h1 class="text-[32px] font-bold">Review</h1>
        <p class="text-charcoal/60 mt-2 text-sm">{{ __('checkout.review.subtitle') }}</p>
    </div>

    <div class="space-y-6">
        <!-- Shipping Information -->
        <div class="bg-card-bg rounded-xl p-6">
            <div class="mb-4 flex items-start justify-between">
                <h2 class="text-lg font-bold">{{ __('checkout.steps.shipping') }}</h2>
                <a
                    href="{{ route('checkout.previous', ['step' => 'contact']) }}"
                    class="text-olive hover:text-white border border-olive bg-white p-1 hover:bg-olive rounded-2xl duration-300 text-sm"
                >

                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.7238 1.0313C12.7664 -0.343766 14.8336 -0.343766 15.8762 1.0313L16.2293 1.49696C16.7982 2.24724 17.7277 2.63222 18.6605 2.50397L19.2394 2.42437C20.949 2.18931 22.4107 3.65102 22.1756 5.3606L22.096 5.93954C21.9678 6.87235 22.3528 7.80178 23.103 8.37068L23.5687 8.72377C24.9438 9.76642 24.9438 11.8336 23.5687 12.8762L23.103 13.2293C22.3528 13.7982 21.9678 14.7277 22.096 15.6605L22.1756 16.2394C22.4107 17.949 20.949 19.4107 19.2394 19.1756L18.6605 19.096C17.7277 18.9678 16.7982 19.3528 16.2293 20.103L15.8762 20.5687C14.8336 21.9438 12.7664 21.9438 11.7238 20.5687L11.3707 20.103C10.8018 19.3528 9.87235 18.9678 8.93954 19.096L8.3606 19.1756C6.65102 19.4107 5.18931 17.949 5.42437 16.2394L5.50397 15.6605C5.63222 14.7277 5.24724 13.7982 4.49696 13.2293L4.0313 12.8762C2.65623 11.8336 2.65623 9.76642 4.0313 8.72377L4.49696 8.37068C5.24724 7.80178 5.63222 6.87235 5.50397 5.93954L5.42437 5.3606C5.18931 3.65102 6.65102 2.18931 8.3606 2.42437L8.93954 2.50397C9.87235 2.63222 10.8018 2.24724 11.3707 1.49696L11.7238 1.0313Z" fill="currentColor" fill-opacity="0.15"/>
                        <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M9.92377 2.23125C10.9664 0.856185 13.0336 0.856185 14.0762 2.23125L14.4293 2.69691C14.9982 3.44719 15.9277 3.83218 16.8605 3.70392L17.4394 3.62432C19.149 3.38926 20.6107 4.85097 20.3756 6.56055L20.296 7.13949C20.1678 8.0723 20.5528 9.00173 21.303 9.57064L21.7687 9.92372C23.1438 10.9664 23.1438 13.0335 21.7687 14.0762L21.303 14.4293C20.5528 14.9982 20.1678 15.9276 20.296 16.8604L20.3756 17.4394C20.6107 19.1489 19.149 20.6106 17.4394 20.3756L16.8605 20.296C15.9277 20.1677 14.9982 20.5527 14.4293 21.303L14.0762 21.7687C13.0336 23.1437 10.9664 23.1437 9.92377 21.7687L9.57068 21.303C9.00178 20.5527 8.07234 20.1677 7.13954 20.296L6.5606 20.3756C4.85102 20.6106 3.38931 19.1489 3.62437 17.4394L3.70397 16.8604C3.83222 15.9276 3.44724 14.9982 2.69695 14.4293L2.23129 14.0762C0.856231 13.0335 0.856231 10.9664 2.23129 9.92372L2.69695 9.57064C3.44724 9.00173 3.83222 8.0723 3.70397 7.13949L3.62437 6.56055C3.38931 4.85097 4.85102 3.38926 6.5606 3.62432L7.13954 3.70392C8.07234 3.83218 9.00178 3.44719 9.57068 2.69691L9.92377 2.23125Z" stroke="currentColor" stroke-width="2"/>
                    </svg>


                </a>
            </div>
            <div class="grid grid-cols-4 gap-y-6 text-sm">
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
                    class="text-olive hover:text-white border border-olive bg-white p-1 hover:bg-olive rounded-2xl duration-300 text-sm"
                >
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.7238 1.0313C12.7664 -0.343766 14.8336 -0.343766 15.8762 1.0313L16.2293 1.49696C16.7982 2.24724 17.7277 2.63222 18.6605 2.50397L19.2394 2.42437C20.949 2.18931 22.4107 3.65102 22.1756 5.3606L22.096 5.93954C21.9678 6.87235 22.3528 7.80178 23.103 8.37068L23.5687 8.72377C24.9438 9.76642 24.9438 11.8336 23.5687 12.8762L23.103 13.2293C22.3528 13.7982 21.9678 14.7277 22.096 15.6605L22.1756 16.2394C22.4107 17.949 20.949 19.4107 19.2394 19.1756L18.6605 19.096C17.7277 18.9678 16.7982 19.3528 16.2293 20.103L15.8762 20.5687C14.8336 21.9438 12.7664 21.9438 11.7238 20.5687L11.3707 20.103C10.8018 19.3528 9.87235 18.9678 8.93954 19.096L8.3606 19.1756C6.65102 19.4107 5.18931 17.949 5.42437 16.2394L5.50397 15.6605C5.63222 14.7277 5.24724 13.7982 4.49696 13.2293L4.0313 12.8762C2.65623 11.8336 2.65623 9.76642 4.0313 8.72377L4.49696 8.37068C5.24724 7.80178 5.63222 6.87235 5.50397 5.93954L5.42437 5.3606C5.18931 3.65102 6.65102 2.18931 8.3606 2.42437L8.93954 2.50397C9.87235 2.63222 10.8018 2.24724 11.3707 1.49696L11.7238 1.0313Z" fill="currentColor" fill-opacity="0.15"/>
                        <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M9.92377 2.23125C10.9664 0.856185 13.0336 0.856185 14.0762 2.23125L14.4293 2.69691C14.9982 3.44719 15.9277 3.83218 16.8605 3.70392L17.4394 3.62432C19.149 3.38926 20.6107 4.85097 20.3756 6.56055L20.296 7.13949C20.1678 8.0723 20.5528 9.00173 21.303 9.57064L21.7687 9.92372C23.1438 10.9664 23.1438 13.0335 21.7687 14.0762L21.303 14.4293C20.5528 14.9982 20.1678 15.9276 20.296 16.8604L20.3756 17.4394C20.6107 19.1489 19.149 20.6106 17.4394 20.3756L16.8605 20.296C15.9277 20.1677 14.9982 20.5527 14.4293 21.303L14.0762 21.7687C13.0336 23.1437 10.9664 23.1437 9.92377 21.7687L9.57068 21.303C9.00178 20.5527 8.07234 20.1677 7.13954 20.296L6.5606 20.3756C4.85102 20.6106 3.38931 19.1489 3.62437 17.4394L3.70397 16.8604C3.83222 15.9276 3.44724 14.9982 2.69695 14.4293L2.23129 14.0762C0.856231 13.0335 0.856231 10.9664 2.23129 9.92372L2.69695 9.57064C3.44724 9.00173 3.83222 8.0723 3.70397 7.13949L3.62437 6.56055C3.38931 4.85097 4.85102 3.38926 6.5606 3.62432L7.13954 3.70392C8.07234 3.83218 9.00178 3.44719 9.57068 2.69691L9.92377 2.23125Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-4 gap-y-6 text-sm">
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
                    class="text-olive hover:text-white border border-olive bg-white p-1 hover:bg-olive rounded-2xl duration-300 text-sm"
                >
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.7238 1.0313C12.7664 -0.343766 14.8336 -0.343766 15.8762 1.0313L16.2293 1.49696C16.7982 2.24724 17.7277 2.63222 18.6605 2.50397L19.2394 2.42437C20.949 2.18931 22.4107 3.65102 22.1756 5.3606L22.096 5.93954C21.9678 6.87235 22.3528 7.80178 23.103 8.37068L23.5687 8.72377C24.9438 9.76642 24.9438 11.8336 23.5687 12.8762L23.103 13.2293C22.3528 13.7982 21.9678 14.7277 22.096 15.6605L22.1756 16.2394C22.4107 17.949 20.949 19.4107 19.2394 19.1756L18.6605 19.096C17.7277 18.9678 16.7982 19.3528 16.2293 20.103L15.8762 20.5687C14.8336 21.9438 12.7664 21.9438 11.7238 20.5687L11.3707 20.103C10.8018 19.3528 9.87235 18.9678 8.93954 19.096L8.3606 19.1756C6.65102 19.4107 5.18931 17.949 5.42437 16.2394L5.50397 15.6605C5.63222 14.7277 5.24724 13.7982 4.49696 13.2293L4.0313 12.8762C2.65623 11.8336 2.65623 9.76642 4.0313 8.72377L4.49696 8.37068C5.24724 7.80178 5.63222 6.87235 5.50397 5.93954L5.42437 5.3606C5.18931 3.65102 6.65102 2.18931 8.3606 2.42437L8.93954 2.50397C9.87235 2.63222 10.8018 2.24724 11.3707 1.49696L11.7238 1.0313Z" fill="currentColor" fill-opacity="0.15"/>
                        <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M9.92377 2.23125C10.9664 0.856185 13.0336 0.856185 14.0762 2.23125L14.4293 2.69691C14.9982 3.44719 15.9277 3.83218 16.8605 3.70392L17.4394 3.62432C19.149 3.38926 20.6107 4.85097 20.3756 6.56055L20.296 7.13949C20.1678 8.0723 20.5528 9.00173 21.303 9.57064L21.7687 9.92372C23.1438 10.9664 23.1438 13.0335 21.7687 14.0762L21.303 14.4293C20.5528 14.9982 20.1678 15.9276 20.296 16.8604L20.3756 17.4394C20.6107 19.1489 19.149 20.6106 17.4394 20.3756L16.8605 20.296C15.9277 20.1677 14.9982 20.5527 14.4293 21.303L14.0762 21.7687C13.0336 23.1437 10.9664 23.1437 9.92377 21.7687L9.57068 21.303C9.00178 20.5527 8.07234 20.1677 7.13954 20.296L6.5606 20.3756C4.85102 20.6106 3.38931 19.1489 3.62437 17.4394L3.70397 16.8604C3.83222 15.9276 3.44724 14.9982 2.69695 14.4293L2.23129 14.0762C0.856231 13.0335 0.856231 10.9664 2.23129 9.92372L2.69695 9.57064C3.44724 9.00173 3.83222 8.0723 3.70397 7.13949L3.62437 6.56055C3.38931 4.85097 4.85102 3.38926 6.5606 3.62432L7.13954 3.70392C8.07234 3.83218 9.00178 3.44719 9.57068 2.69691L9.92377 2.23125Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
            </div>
            <div class="space-y-1 text-sm">
                <p class="py-2">
                   <span class="font-bold">Payment Method:</span>
                    {{ \App\Enums\PaymentMethod::tryFrom($checkoutData['payment_method'])->name }}
                </p>
                <div class="grid grid-cols-4 gap-y-6 text-sm">
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
