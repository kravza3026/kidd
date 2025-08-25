@extends('store.checkout.layouts.checkout')

@section('checkout-form')
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Payment Method</h1>
        <p class="text-charcoal/60 mt-2 text-sm">Choose your preferred payment method</p>
    </div>

    <form action="{{ route('checkout.process.payment') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Payment Methods -->
        <div class="space-y-4">
            <h2 class="text-lg font-bold">Select Payment Method</h2>

            <!-- Payment Method Cards -->
            <div class="grid gap-4">
                <!-- Credit Card Option -->
                <label
                    class="hover:border-olive relative flex cursor-pointer items-center rounded-2xl border border-gray-200 p-4 transition-colors"
                >
                    <input
                        type="radio"
                        name="payment_method"
                        value="3"
                        class="peer absolute opacity-0"
                        @checked(old('payment_method', $checkoutData['payment_method'] ?? '') == 3)
                    />
                    <div class="flex items-center gap-4">
                        <div
                            class="peer-checked:border-olive flex h-6 w-6 items-center justify-center rounded-full border border-gray-300"
                        >
                            <div
                                class="bg-olive h-3 w-3 rounded-full opacity-0 transition-opacity peer-checked:opacity-100"
                            ></div>
                        </div>
                        <div>
                            <p class="font-bold">Credit Card</p>
                            <p class="text-charcoal/60 text-sm">Visa, Mastercard</p>
                        </div>
                    </div>
                </label>

                <!-- Cash on Delivery Option -->
                <label
                    class="hover:border-olive relative flex cursor-pointer items-center rounded-2xl border border-gray-200 p-4 transition-colors"
                >
                    <input
                        type="radio"
                        name="payment_method"
                        value="1"
                        class="peer absolute opacity-0"
                        @checked(old('payment_method', $checkoutData['payment_method'] ?? null) == 1)
                    />
                    <div class="flex items-center gap-4">
                        <div
                            class="peer-checked:border-olive flex h-6 w-6 items-center justify-center rounded-full border border-gray-300"
                        >
                            <div
                                class="bg-olive h-3 w-3 rounded-full opacity-0 transition-opacity peer-checked:opacity-100"
                            ></div>
                        </div>
                        <div>
                            <p class="font-bold">Cash on Delivery</p>
                            <p class="text-charcoal/60 text-sm">Pay when you receive</p>
                        </div>
                    </div>
                </label>
            </div>

            @error('payment_method')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Credit Card Details Section -->
        <div id="card-details" class="space-y-4" x-show="$refs.cardRadio.checked">
            <h2 class="text-lg font-bold">Card Details</h2>

            <div class="space-y-4">
                <div>
                    <label for="card_number" class="text-charcoal block text-sm font-medium">Card Number</label>
                    <input
                        type="text"
                        name="card_number"
                        id="card_number"
                        class="focus:border-olive focus:ring-olive mt-2 w-full rounded-xl border border-gray-200 p-3 placeholder-gray-400"
                        placeholder="0000 0000 0000 0000"
                    />
                    @error('card_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="card_expiry" class="text-charcoal block text-sm font-medium">Expiry Date</label>
                        <input
                            type="text"
                            name="card_expiry"
                            id="card_expiry"
                            class="focus:border-olive focus:ring-olive mt-2 w-full rounded-xl border border-gray-200 p-3 placeholder-gray-400"
                            placeholder="MM/YY"
                        />
                        @error('card_expiry')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="card_cvv" class="text-charcoal block text-sm font-medium">CVV</label>
                        <input
                            type="text"
                            name="card_cvv"
                            id="card_cvv"
                            class="focus:border-olive focus:ring-olive mt-2 w-full rounded-xl border border-gray-200 p-3 placeholder-gray-400"
                            placeholder="000"
                        />
                        @error('card_cvv')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex items-center justify-between pt-8">
            <a
                href="{{ route('checkout.previous', ['step' => 'payment']) }}"
                class="text-charcoal/60 hover:text-charcoal flex items-center gap-2 text-sm transition-colors"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Contact
            </a>
            <button
                type="submit"
                class="bg-olive hover:bg-olive-dark focus:ring-olive rounded-xl px-6 py-3 text-white transition-colors focus:ring-2 focus:ring-offset-2 focus:outline-none"
            >
                Continue to Review
            </button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cardDetails = document.getElementById('card-details');
            const paymentInputs = document.querySelectorAll('input[name="payment_method"]');

            function toggleCardDetails() {
                const selectedMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
                cardDetails.style.display = selectedMethod === '3' ? 'block' : 'none';
            }

            paymentInputs.forEach((input) => {
                input.addEventListener('change', toggleCardDetails);
            });

            toggleCardDetails();
        });
    </script>
@endpush
