<!-- Right Column - Order Summary -->
<div class="order-1 lg:order-2 bg-card-bg rounded-2xl p-6">
    <h2 class="text-[18px] font-bold mb-6">{{ __('checkout.order_summary') }}</h2>

    <!-- Order Items -->
    <div class="space-y-4 max-h-[40vh] overflow-y-auto">
        @foreach($items as $item)
            <div class="flex gap-4">
                <div class="bg-white rounded-xl p-2 w-[72px] h-[72px]">
                    <img src="{{ Vite::image($item->model->product->main_image) }}" alt="{{ $item->model->product->name }}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <p class="font-bold">{{ $item->model->product->name }}</p>
                    <div class="flex gap-2 text-[14px] text-charcoal/60">
                        <span>{{ $item->model->color->name }}</span>
                        <span>|</span>
                        <span>{{ $item->model->size->name }}</span>
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
        <div class="flex justify-between text-[14px]">
            <span class="text-charcoal/60">{{ __('checkout.subtotal') }}</span>
            <span class="font-bold">{{ $sub_total }}</span>
        </div>
        <div class="flex justify-between text-[14px]">
            <span class="text-charcoal/60">{{ __('checkout.shipping') }}</span>
            <span class="font-bold">{{ $sub_total }}</span>
        </div>
        <div class="flex justify-between text-[18px] font-bold pt-3 border-t">
            <span>{{ __('checkout.total') }}</span>
            <span>{{ $total }}</span>
        </div>
    </div>
</div>
