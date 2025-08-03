<x-app-layout>
<div class="container my-10">
{{--    <h2 class="mb-4 inline-block relative text-5xl font-bold leading-[62px] tracking-[-2%] text-charcoal/80">--}}
{{--        My Cart--}}
{{--        <x-ui.badge class="absolute text-white text-xl font-bold size-7 rounded-full -right-10 top-0 bg-olive">{{ $count ?? 0 }}</x-ui.badge>--}}
{{--    </h2>--}}

    <div class="w-full flex gap-x-16">
        <div class="w-full flex grow basis-full shrink-1 mt-4">
            <div class="flex flex-col space-y-6 w-full last:[&>div]:border-b-0">
                <div data-vue-component="Cart"></div>
            </div>
        </div>
    </div>
</div>


</x-app-layout>
