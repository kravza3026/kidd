@props(['background' => ''])

<li {{ $attributes->merge(['class' => $background . ' w-fit border border-black/20 rounded-full flex items-center px-4 py-2 text-[14px] text-nowrap']) }}>
    {{ $slot }}
</li>
