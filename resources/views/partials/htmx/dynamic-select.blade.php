<option value="0">
    {{ __('checkout.shipping.form.shipping_city_placeholder') }}
</option>
@foreach ($cities as $city)
    <option value="{{ $city->id }}">{{ $city->name }}</option>
@endforeach
