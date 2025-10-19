<div class="border-light-border h-fit w-full space-y-4 rounded-2xl border bg-white p-3 shadow">
    <p class="text-2xl font-bold">Return information</p>
    <p class="text-sm">Product doesn't match of fit? You can contact us for return within 14 days of receiving it!</p>
    <x-ui.button
        as="a"
        href="{{ route('orders.return', $order) }}"
        left_icon="false"
        right_icon="false"
        class="text-sm font-bold"
    >
        <img class="size-5" src="{{ Vite::image('icons/return.svg') }}" alt="icon return" />
        Ask for return
    </x-ui.button>
</div>
