<div class="border-light-border flex w-full p-1 md:block md:items-center md:rounded-2xl md:border md:p-0">
    <div class="bg-card-bg h-fit max-w-3/12 rounded-2xl md:max-w-full md:rounded-t-2xl md:rounded-b-none">
        <img
            class="w-auto p-2 md:h-48 md:max-w-full md:p-8"
            src="{{ Vite::image($product->variant->product->main_image) }}"
            alt="{{ $product->variant->product->name }}"
        />
    </div>

    <div class="max-w-3/5 overflow-hidden px-4 sm:max-w-full md:py-3">
        <p class="truncate text-sm font-medium text-nowrap">
            {{ $product->variant->product->name }}
        </p>
        <div class="flex items-center justify-items-start gap-x-1 py-1 text-nowrap">
            <div class="flex items-center gap-x-1">
                <span
                    class="border-light-border size-4 rounded-full border"
                    style="background-color: {{ $product->variant->color->hex }}"
                ></span>
                <span class="text-sm opacity-40">
                    {{ $product->variant->color->name }}
                </span>
            </div>
            <p class="border-l-light-border border-l pl-2 text-sm opacity-40">
                {{ $product->variant->size->name }}
            </p>
        </div>
        <div class="mt-1 flex items-center justify-between">
            <p class="text-olive text-base font-bold">
                {{ (int) ($product->variant->price_final / 100) }} lei
                <span class="text-dark text-sm font-bold">-{{ $product->variant->discount_display }}%</span>
            </p>
            <p class="flex items-center">
                ×
                <span>{{ $product->quantity }}</span>
            </p>
        </div>
    </div>
</div>
