@props(['name', 'value' => null, 'type' => 'text'])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $attributes->merge(['class' => 'w-full rounded-xl border-[1.5px] border-[#eeeeee] p-3 text-base leading-tight text-charcoal focus:border-gray-200 focus:ring-gray-200']) }}
/>
