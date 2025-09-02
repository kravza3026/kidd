<div class=" w-full border-light-border flex items-center p-1 md:block md:rounded-2xl md:border md:p-0">
    <div class="bg-card-bg h-fit max-w-1/4 rounded-2xl md:max-w-full md:rounded-t-2xl md:rounded-b-none">
        <img
            class="md:max-w-full md:p-8 h-24 md:h-48 w-auto"
            src="{{ Vite::image($product->variant->product->main_image) }}"
            alt="product name"
        />
    </div>

    <div class="px-4">
        <p class="truncate text-sm font-medium text-nowrap">
            {{ $product->variant->product->name }}
        </p>
        <div class="flex items-center justify-start gap-x-1 py-1">
            <span
                class="border-light-border size-4 rounded-full border"
                style="background-color: {{ $product->variant->color->hex }}"
            ></span>
            <span class="text-sm opacity-40">
                {{ $product->variant->color->name }}
            </span>
            <p class="border-l-light-border border-l pl-2 text-sm opacity-40">
                {{ $product->variant->size->name }}
            </p>
        </div>
        <div class="mt-4 flex items-center justify-between">
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
