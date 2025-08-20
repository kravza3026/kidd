<x-app-layout>
    <div class="container mx-auto  py-5">
        <h1 class="text-5xl font-bold mb-5">Checkout</h1>
        <!-- Checkout Progress -->
{{--        <div class="mb-12">--}}
{{--            <div class="flex justify-between max-w-[600px] mx-auto">--}}
{{--                @foreach(['Shipping', 'Contact', 'Payment', 'Review'] as $step)--}}
{{--                    <div class="flex flex-col items-center">--}}
{{--                        <div @class([--}}
{{--                            'w-8 h-8 rounded-full flex items-center justify-center mb-2',--}}
{{--                            'bg-olive text-white' => Str::lower($step) === $currentStep,--}}
{{--                            'bg-gray-200' => Str::lower($step) !== $currentStep--}}
{{--                        ])>--}}
{{--                            {{ $loop->iteration }}--}}
{{--                        </div>--}}
{{--                        <span @class([--}}
{{--                            'text-sm',--}}
{{--                            'text-olive font-medium' => Str::lower($step) === $currentStep,--}}
{{--                            'text-charcoal/60' => Str::lower($step) !== $currentStep--}}
{{--                        ])>--}}
{{--                            {{ $step }}--}}
{{--                        </span>--}}
{{--                    </div>--}}
{{--                    @unless($loop->last)--}}
{{--                        <div class="flex-1 mt-4">--}}
{{--                            <div @class([--}}
{{--                                'h-0.5',--}}
{{--                                'bg-olive' => $loop->iteration < array_search(Str::lower($currentStep), ['shipping', 'contact', 'payment', 'review']) + 1,--}}
{{--                                'bg-gray-200' => $loop->iteration >= array_search(Str::lower($currentStep), ['shipping', 'contact', 'payment', 'review']) + 1--}}
{{--                            ])></div>--}}
{{--                        </div>--}}
{{--                    @endunless--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_400px] gap-6">
            <!-- Left Column - Form -->
            <div class="order-2 lg:order-1">
                @yield('checkout-form')
            </div>

            @include('store.checkout.layouts.summary')
        </div>
    </div>
</x-app-layout>
