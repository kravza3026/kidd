@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm sm:font-medium sm:text-gray-700 leading-[14px] text-[#020202]']) }}>
    {{ $value ?? $slot }}
</label>
