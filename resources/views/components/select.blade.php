@props([
    'id',
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => true,
    'icon' => null,
    'disabled' => false,
    'toggleTag' => '<button type="button" aria-expanded="false"><span class="me-4" data-icon></span><span class="text-gray-800 " data-title></span></button>',
    'customClass' => '',
])

@php
    $disabled_class = $disabled ? 'bg-[#F8F7F2]' : 'bg-white';
@endphp

<div class="flex flex-col gap-3 mt-3 {{ $customClass }}">
    <!-- Select -->
    @if ($label)
        <label for="{{ $id ?? Str::kebab($name) }}" class="text-[14px] font-bold">
            {{ $label }}
        </label>
    @endif
        <select @disabled($disabled) name="{{$name}}" id="{{$id}}"
                {{ $attributes->merge(['class' => "p-3 pe-8 flex w-full text-charcoal ${disabled_class} text-sm leading-none
                border border-light-border focus:outline-hidden rounded-xl"]) }}>
            @if($placeholder)
                <option value="0">{{ $placeholder }}</option>
            @endif
            @foreach($options as $key => $option)
                <option value="{{ $key }}" @selected($key == $selected)>{{$option}}</option>
            @endforeach
        </select>
    <!-- End Select -->
</div>
