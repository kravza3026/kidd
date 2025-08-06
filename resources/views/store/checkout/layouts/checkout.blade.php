<x-app-layout>
    <div class="max-w-7xl mx-auto px-5 xl:px-0 py-24">
        <!-- Checkout Progress -->
        <div class="mb-12">
            <div class="flex justify-between max-w-[600px] mx-auto">
                @foreach(['Shipping', 'Contact', 'Payment', 'Review'] as $step)
                    <div class="flex flex-col items-center">
                        <div @class([
                            'w-8 h-8 rounded-full flex items-center justify-center mb-2',
                            'bg-olive text-white' => Str::lower($step) === $currentStep,
                            'bg-gray-200' => Str::lower($step) !== $currentStep
                        ])>
                            {{ $loop->iteration }}
                        </div>
                        <span @class([
                            'text-sm',
                            'text-olive font-medium' => Str::lower($step) === $currentStep,
                            'text-charcoal/60' => Str::lower($step) !== $currentStep
                        ])>
                            {{ $step }}
                        </span>
                    </div>
                    @unless($loop->last)
                        <div class="flex-1 mt-4">
                            <div @class([
                                'h-0.5',
                                'bg-olive' => $loop->iteration < array_search(Str::lower($currentStep), ['shipping', 'contact', 'payment', 'review']) + 1,
                                'bg-gray-200' => $loop->iteration >= array_search(Str::lower($currentStep), ['shipping', 'contact', 'payment', 'review']) + 1
                            ])></div>
                        </div>
                    @endunless
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_400px] gap-6">
            <!-- Left Column - Form -->
            <div class="order-2 lg:order-1">
                @yield('checkout-form')
            </div>

            <!-- Right Column - Order Summary -->
            <div class="order-1 lg:order-2 bg-card-bg rounded-2xl p-6">
                <h2 class="text-lg font-bold mb-6">Order Summary</h2>

                <!-- Order Items -->
                <div class="space-y-4 max-h-[40vh] overflow-y-auto">
                    @foreach($items as $item)
                        <div class="flex gap-4">
                            <div class="bg-white rounded-xl p-2 w-[72px] h-[72px]">
                                <img src="{{ Vite::image($item->model->product->main_image) }}"
                                     alt="{{ $item->model->product->name }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="font-bold">{{ $item->model->product->name }}</p>
                                <div class="flex gap-2 text-sm text-charcoal/60">
                                    <span>{{ $item->model->color->name }}</span>
                                    <span>|</span>
                                    <span>{{ $item->model->size->name }}</span>
                                </div>
                                <div class="flex justify-between mt-1">
                                    <span class="text-sm text-charcoal/60">x{{ $item->qty }}</span>
                                    <span class="font-bold">${{ number_format($item->price / 100, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Totals -->
                <div class="mt-6 space-y-3 pt-6 border-t border-gray-200">
                    <div class="flex justify-between text-sm">
                        <span class="text-charcoal/60">Subtotal</span>
                        <span class="font-bold">${{ number_format($sub_total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-charcoal/60">Shipping</span>
                        <span class="font-bold">${{ number_format($sub_total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold pt-3 border-t border-gray-200">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
