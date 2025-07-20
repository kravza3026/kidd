@props(['active'])

@php
    $classes = ($active ?? false)
                ? ' border-b-green-500 text-green-500'
                : ' border-b-transparent text-black';
@endphp

<a {{ $attributes->merge(['class' => 'h-full px-2 md:px-4 lg:px-6 items-center border-b-2 font-bold hover:text-green-500 hover:border-b-green-500'.$classes]) }} {{ $active ? 'aria-current="page"' : '' }}>
    {{ $slot }}
</a>
