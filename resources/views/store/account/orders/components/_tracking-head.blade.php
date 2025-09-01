<div class="flex items-start gap-x-4 px-4">
    <a href="{{ route('orders.index') }}" class="p-3 border border-light-border rounded-full">
        <img class="size-3 opacity-40" src="{{Vite::image('/icons/back.svg')}}" alt="icon arrow left">
    </a>
    <div class="space-y-2">
        <div class="flex gap-x-2 items-center">
            <p class="font-bold text-2xl">Order tracking</p>
            <span class="opacity-10 text-[4px]">⬤</span>
            <p class="font-bold text-olive text-2xl">#{{$order->id}}</p>
            <span class="inline-block text-white text-[12px] font-bold bg-olive px-3 py-1 rounded-2xl">{{ $order->status->name }}</span>
        </div>
        <div class="flex gap-x-2 items-center">
            <p class="text-sm opacity-40 leading-[-2%]">Tracking code:</p>
            <div id="copyBtn" class=" flex items-center gap-x-2 cursor-pointer">
                <p id="copy" class="underline font-bold text-sm">UE239931833HK</p>
                <img class="size-4 opacity-40" src="{{Vite::image('/icons/olive/copy.svg')}}" alt="icon arrow left">
            </div>
        </div>
    </div>
</div>
<hr class="my-4 border-light-border">

