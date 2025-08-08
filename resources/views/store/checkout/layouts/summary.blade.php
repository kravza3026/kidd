<!-- Right Column - Order Summary -->
<div class="order-1 lg:order-2 bg-card-bg rounded-2xl p-6">
    <h2 class="text-[18px] font-bold mb-6">{{ __('checkout.order_summary') }}</h2>

    <!-- Order Items -->
    <div class="space-y-4 max-h-[40vh] overflow-y-auto">
        @foreach($items as $item)
            <div class="flex gap-4">
                <div class="bg-white rounded-xl p-2 w-[72px] h-[72px]">
                    <img src="{{ Vite::image($item->model->main_image) }}" alt="{{ $item->model->name }}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <p class="font-bold">{{ $item->model->name }}</p>
                    <div class="flex gap-2 text-[14px] text-charcoal/60">
                        <span>{{ $item->variant->color->name }}</span>
                        <span>|</span>
                        <span>{{ $item->variant->size->name }}</span>
                    </div>
                    <div class="flex justify-between mt-1">
                        <span class="text-[14px] text-charcoal/60">x{{ $item->qty }}</span>
                        <span class="font-bold">{{ $item->price / 100 }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Order Totals -->
    <div class="mt-6 space-y-3 pt-6 border-t">
        @foreach($fees as $fee)
            <div class="flex justify-between text-[14px]">
                <span class="text-charcoal/60 font-bold">
                    {{ $fee->options['description'] }}
                </span>
                <span class="font-bold">
                    {{ $fee->amount / 100 }} MDL
                </span>
            </div>
        @endforeach
        @foreach($coupons as $coupon)
            <div class="flex justify-between text-[14px]">
                <span class="text-charcoal/60 font-bold">
                    {{ $coupon->options['description'] }}
                </span>
                <span class="font-bold">
                    {{ $coupon->discounted / 100 }} MDL
                </span>
            </div>
        @endforeach
        <div class="flex justify-between text-[14px]">
            <span class="text-charcoal/60">{{ __('checkout.sub_total') }}</span>
            <span class="font-bold">{{ $sub_total }}</span>
        </div>
        <div class="flex justify-between text-[14px]">
            <span class="text-charcoal/60">{{ __('checkout.fee_sub_total') }}</span>
            <span class="font-bold">{{ $fee_sub_total }}</span>
        </div>
        <div class="flex justify-between text-[14px]">
            <span class="text-charcoal/60">{{ __('checkout.total_discount') }}</span>
            <span class="font-bold">{{ $total_discount }}</span>
        </div>
        <div class="flex justify-between text-[18px] font-bold pt-3 border-t">
            <span>{{ __('checkout.total') }}</span>
            <span>{{ $total }}</span>
        </div>
    </div>
</div>
