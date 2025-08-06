@extends('store.checkout.layouts.checkout')

@section('checkout-form')
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Payment Method</h1>
        <p class="text-sm text-charcoal/60 mt-2">Choose your preferred payment method</p>
    </div>

    <form action="{{ route('checkout.process', ['step' => 'payment']) }}" method="POST" class="space-y-6">
        @csrf

        <!-- Payment Methods -->
        <div class="space-y-4">
            <h2 class="text-lg font-bold">Select Payment Method</h2>

            <!-- Payment Method Cards -->
            <div class="grid gap-4">
                <!-- Credit Card Option -->
                <label class="relative flex items-center p-4 border border-gray-200 rounded-2xl cursor-pointer hover:border-olive transition-colors">
                    <input type="radio" name="payment_method" value="card"
                           class="peer absolute opacity-0"
                        {{ old('payment_method', $checkoutData['payment_method'] ?? '') == 'card' ? 'checked' : '' }}>
                    <div class="flex items-center gap-4">
                        <div class="w-6 h-6 border border-gray-300 rounded-full flex items-center justify-center peer-checked:border-olive">
                            <div class="w-3 h-3 rounded-full bg-olive opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                        </div>
                        <div>
                            <p class="font-bold">Credit Card</p>
                            <p class="text-sm text-charcoal/60">Visa, Mastercard</p>
                        </div>
                    </div>
                </label>

                <!-- Cash on Delivery Option -->
                <label class="relative flex items-center p-4 border border-gray-200 rounded-2xl cursor-pointer hover:border-olive transition-colors">
                    <input type="radio" name="payment_method" value="cash"
                           class="peer absolute opacity-0"
                        {{ old('payment_method', $checkoutData['payment_method'] ?? '') == 'cash' ? 'checked' : '' }}>
                    <div class="flex items-center gap-4">
                        <div class="w-6 h-6 border border-gray-300 rounded-full flex items-center justify-center peer-checked:border-olive">
                            <div class="w-3 h-3 rounded-full bg-olive opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                        </div>
                        <div>
                            <p class="font-bold">Cash on Delivery</p>
                            <p class="text-sm text-charcoal/60">Pay when you receive</p>
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
                    <label for="card_number" class="block text-sm font-medium text-charcoal">
                        Card Number
                    </label>
                    <input type="text" name="card_number" id="card_number"
                           class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive placeholder-gray-400"
                           placeholder="0000 0000 0000 0000">
                    @error('card_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="card_expiry" class="block text-sm font-medium text-charcoal">
                            Expiry Date
                        </label>
                        <input type="text" name="card_expiry" id="card_expiry"
                               class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive placeholder-gray-400"
                               placeholder="MM/YY">
                        @error('card_expiry')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="card_cvv" class="block text-sm font-medium text-charcoal">
                            CVV
                        </label>
                        <input type="text" name="card_cvv" id="card_cvv"
                               class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive placeholder-gray-400"
                               placeholder="000">
                        @error('card_cvv')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center pt-8">
            <a href="{{ route('checkout.previous', ['step' => 'payment']) }}"
               class="flex items-center gap-2 text-sm text-charcoal/60 hover:text-charcoal transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Contact
            </a>
            <button type="submit"
                    class="bg-olive text-white px-6 py-3 rounded-xl hover:bg-olive-dark focus:outline-none focus:ring-2 focus:ring-olive focus:ring-offset-2 transition-colors">
                Continue to Review
            </button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cardDetails = document.getElementById('card-details');
            const paymentInputs = document.querySelectorAll('input[name="payment_method"]');

            function toggleCardDetails() {
                const selectedMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
                cardDetails.style.display = selectedMethod === 'card' ? 'block' : 'none';
            }

            paymentInputs.forEach(input => {
                input.addEventListener('change', toggleCardDetails);
            });

            toggleCardDetails();
        });
    </script>
@endpush
