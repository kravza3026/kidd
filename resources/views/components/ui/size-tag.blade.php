@props(['background' => '', 'link' => '#'])

<li {{ $attributes->merge(['class' => $background . ' bg-white hover:bg-light-orange hover:text-olive w-fit light_border rounded-full flex items-center px-4 py-2 text-[14px] text-nowrap']) }}>
    <a href="{!! $link !!}">
        {{ $slot }}
    </a>
</li>
