<div class="flex items-start gap-x-4 px-4">
    <a href="{{ route('orders.index') }}" class="border-light-border rounded-full border p-3">
        <img class="size-3 opacity-40" src="{{ Vite::image('icons/back.svg') }}" alt="icon arrow left" />
    </a>
    <div class="space-y-2">
        <div class="flex items-center gap-x-2">
            <p class="text-2xl font-bold">Order tracking</p>
            <span class="text-[4px] opacity-10">⬤</span>
            <p class="text-olive text-2xl font-bold">#{{ $order->id }}</p>
            <span class="bg-olive inline-block rounded-2xl px-3 py-1 text-[12px] font-bold text-white">
                {{ $order->status->name }}
            </span>
        </div>
        <div class="flex items-center gap-x-2">
            <p class="text-sm leading-[-2%] opacity-40">Tracking code:</p>
            <div id="copyBtn" class="flex cursor-pointer items-center gap-x-2">
                <p id="copy" class="text-sm font-bold underline">UE239931833HK</p>
                <img class="size-4 opacity-40" src="{{ Vite::image('icons/olive/copy.svg') }}" alt="icon arrow left" />
            </div>
        </div>
    </div>
</div>
<hr class="border-light-border my-4" />
