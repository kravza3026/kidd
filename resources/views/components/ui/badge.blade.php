@props(['background' => ''])

<div {{ $attributes->merge(['class' => '' . $background . ' py-1.5 px-2 rounded-xl justify-center items-center inline-flex shadow-md']) }}>
    <div class="text-center text-white text-xs font-bold leading-3">
        {{ $slot }}
    </div>
</div>
