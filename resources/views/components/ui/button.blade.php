@props([
    'size' => 'medium', // small, medium, large
    'left_icon' => false,
    'right_icon' => true,
    'stroke_width' => 2,
    'stroke_color' => 'white',
    'as' => 'div'
])

@php
    switch($size) {
        case 'small':
            $attributes = $attributes->merge(['class' => 'small']);
        case 'medium':
            $attributes = $attributes->merge(['class' => 'medium']);
        case 'large':
            $attributes = $attributes->merge(['class' => 'large']);
        default:
            $attributes = $attributes->merge(['class' => '']);
    }
@endphp

<{{$as}} {{ $attributes->merge(['class' => ' cursor-pointer border-b-4 hover:bg-dark-olive duration-500 transition-all ease-in-out border-dark-olive flex gap-5 items-center bg-olive justify-center w-fit py-3
md:py-4
 px-10 my-5 rounded-2xl text-white']) }}>
    @if(filter_var($left_icon, FILTER_VALIDATE_BOOLEAN))
    <svg
        class="size-3.5 md:size-4"
        width="14"
        height="14"
        viewBox="0 0 14 14"
        fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M2.73335 1.66669H11.6667C12.0349 1.66669 12.3334 1.96516 12.3334 2.33335V11.2667M1.66669 12.3334L11.8 2.20002"
            stroke="{{ $stroke_color }}"
            stroke-width="{{ $stroke_width }}"
            stroke-linecap="round"
            stroke-linejoin="round"
            />
    </svg>
    @endif
    {{ $slot }}
        @if(filter_var($right_icon, FILTER_VALIDATE_BOOLEAN))
        <svg
            class="size-3.5 md:size-4"
            width="14"
            height="14"
            viewBox="0 0 14 14"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M2.73335 1.66669H11.6667C12.0349 1.66669 12.3334 1.96516 12.3334 2.33335V11.2667M1.66669 12.3334L11.8 2.20002"
                stroke="{{ $stroke_color }}"
                stroke-width="{{ $stroke_width }}"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
    @endif
</{{$as}}>
