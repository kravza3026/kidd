@props([
    'size' => 'medium', // small, medium, large
    'left_icon' => false,
    'right_icon' => true,
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

<div {{ $attributes->merge(['class' => 'button py-2.5 px-6 md:py-4 md:px-8 border-b-2 border-dark-olive rounded-xl xl:rounded-2xl text-white text-sm font-bold hover:bg-dark-olive duration-500 transition-all
ease-in-out']) }}>
    @if($left_icon)
    <svg
        class="size-3.5 md:size-4"
        width="14"
        height="14"
        viewBox="0 0 14 14"
        fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M2.73335 1.66669H11.6667C12.0349 1.66669 12.3334 1.96516 12.3334 2.33335V11.2667M1.66669 12.3334L11.8 2.20002"
            stroke="white"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            />
    </svg>
    @endif
    {{ $slot }}
    @if($right_icon)
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
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            />
        </svg>
    @endif
</div>
