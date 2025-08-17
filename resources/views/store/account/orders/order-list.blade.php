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
        @include('store.account.orders.order-list-item')
       </div>
    @endforeach




</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const headers = document.querySelectorAll('.accordion-header');

        headers.forEach(header => {
            header.addEventListener('click', function() {
                const body = this.nextElementSibling;

                // Закриваємо всі інші видимі акордеони
                document.querySelectorAll('.accordion-body').forEach(b => {
                    if (b !== body && b.offsetParent !== null) { // лише видимі
                        b.style.maxHeight = null;
                        b.classList.remove('open');
                        b.previousElementSibling.classList.remove('active');
                    }
                });

                // Перемикаємо поточний
                if (body.classList.contains('open')) {
                    body.style.maxHeight = null;
                    body.classList.remove('open');
                    this.classList.remove('active');
                } else {
                    body.style.maxHeight = body.scrollHeight + "px";
                    body.classList.add('open');
                    this.classList.add('active');
                }
            });
        });
    });
</script>



<style>
    .accordion-header {
        cursor: pointer;
        background: #eee;
        padding: 10px;
        width: 100%;
        text-align: left;
        outline: none;
        transition: all 1.3s;
        border-radius: 1rem;
    }
    .accordion-header.active {
        border-radius: 1rem 1rem 0 0;
        transition: border-radius 1s;
    }

    .accordion-header .accordion-arrow {
        transform: rotate(0deg);
        transition: transform .7s;
    }

    .accordion-header.active .accordion-arrow {
        transform: rotate(180deg);
        transition: all .7s;
        color: var(--color-olive);
    }
    .accordion-header:hover {
        background: #ddd;
    }

    .accordion-body {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease, opacity 0.5s ease;
        opacity: 0;
    }
    .accordion-body.open {
        opacity: 1;
    }


</style>
