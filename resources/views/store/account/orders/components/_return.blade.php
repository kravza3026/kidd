<div class="bg-white border border-light-border space-y-4 rounded-2xl p-3 shadow h-fit w-full">
    <p class="font-bold text-2xl">Return information</p>
    <p class="text-sm">Product doesn't match of fit? You can contact us for return within 14 days of
        receiving it!</p>
    <x-ui.button as="a" href="{{ route('orders.return', $order) }}" left_icon="false" right_icon="false" class=" font-bold text-sm">
        <img class="size-5" src="{{Vite::image('/icons/return.svg')}}" alt="icon return">
        Ask for return
    </x-ui.button>
</div>
