@props(['align' => 'right', 'width' => '', 'contentClasses' => 'p-4 bg-white rounded-full', 'baseClasses' => '', 'triggerClasses' => ''])

@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'custom':
            $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-left end-0 top-[50px]';
            break;
        case 'right':
        default:
            $alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
            break;
    }

    switch ($width) {
        case '48':
            $width = 'w-48';
            break;
        case 'auto':
            $width = 'w-auto min-w-[150%]';
            break;
        case 'full':
            $width = 'w-full ';
            $alignmentClasses .= ' left-0 right-0';
            break;
        case 'w-size':
            $width = 'w-[240px]';
            break;
        default:
            $width = 'w-auto';
            break;
    }
@endphp

{{--relative--}}
<div {{ $attributes->merge(['class' => 'relative']) }} x-data="{ open: false, close() { open: false } }" @click.outside="close()" @close.stop="open = false">
    <div @click="open = ! open" class="{{ $triggerClasses }}">
        {{ $trigger }}
    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-50 mt-2 {{ $width }} rounded-xl shadow-lg {{ $alignmentClasses }}"
         style="display: none;"
         @click.outside="open = false"
    >
        <div class="rounded-xl ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
