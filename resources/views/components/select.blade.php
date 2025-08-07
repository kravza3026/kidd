@props([
    'id',
    'name',
    'label',
    'options' => [],
    'selected' => null,
    'placeholder' => true,
    'placeholder_option' => [0, '---'],
    'icon' => null,
    'toggleTag' => '<button type="button" aria-expanded="false"><span class="me-2" data-icon></span><span class="text-gray-800 " data-title></span></button>',
])

<div>
    <!-- Select -->
    <label for=""></label>
    <select name="{{ $name }}" id="{{$id}}" class="py-2 px-3 pe-8 flex w-full text-charcoal text-sm leading-none border border-light-border rounded-lg">
        @if($placeholder)
            <option value="{{ $placeholder_option[0] }}">{{ $placeholder_option[1] }}</option>
        @endif
        @foreach($options as $option)
            <option value="{{ $option['id'] }}" @selected($option['id'] == $selected)>{{ $option['name'] }}</option>
        @endforeach
    </select>
    <!-- End Select -->
</div>
