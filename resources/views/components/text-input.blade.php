@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'mt-3 p-4 font-normal text-base leading-4 text-charcoal border-[1.5px] border-[#eeeeee] focus:border-gray-100 focus:ring-gray-200
rounded-xl']) !!}>
