@props([
    'id',
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => true,
    'placeholder_option' => [0, '---'],
    'icon' => null,
    'disabled' => false,
    'toggleTag' => '<button type="button" aria-expanded="false"><span class="me-4" data-icon></span><span class="text-gray-800 " data-title></span></button>',
])

<div>
    <!-- Select -->
    <label for="{{$id}}">
        {{ $label }}
        <select @disabled($disabled) name="{{ $name }}" id="{{$id}}" class="py-2 px-3 pe-8 flex w-full text-charcoal {{ $disabled ? 'bg-gray-100' : '' }} text-sm leading-none border border-light-border rounded-lg">
            @if($placeholder)
                <option value="{{ $placeholder_option[0] }}">{{ $placeholder_option[1] }}</option>
            @endif
            @foreach($options as $key => $option)
                <option value="{{ $key }}" @selected($key == $selected)>
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </label>
    <!-- End Select -->
</div>
