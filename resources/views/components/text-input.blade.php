@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'mt-2 font-medium text-sm leading-[14px] text-[#020202] border-[1.5px] border-[#eeeeee] focus:border-gray-100 focus:ring-gray-200 rounded-xl sm:py-3']) !!}>
