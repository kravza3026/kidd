@php
    $orders = [
        ['title' => 'Перший', 'content' => 'Контент першого акордеону.'],
        ['title' => 'Другий', 'content' => 'Контент другого акордеону.'],
        ['title' => 'Третій', 'content' => 'Контент третього акордеону.'],
    ];
@endphp
<section>
    <div class="hidden lg:grid grid-cols-12 my-2 font-bold px-6 py-2">
        <p class="uppercase opacity-40 text-[10px] col-span-3">Order ID</p>
        <p class="uppercase opacity-40 text-[10px] col-span-2">Status</p>
        <p class="uppercase opacity-40 text-[10px] col-span-1">items</p>
        <p class="uppercase opacity-40 text-[10px] col-span-2">Date placed</p>
        <p class="uppercase opacity-40 text-[10px] col-span-2">Delivery date</p>
        <p class="uppercase opacity-40 text-[10px] col-span-2">Price</p>
    </div>
    @foreach ($orders as $order)
        <div class="accordion">
            @include('store.account.orders.order-list-item', [
                'order' => $order,
                'index' => $loop->iteration // починається з 1
            ])
        </div>
    @endforeach




</section>

