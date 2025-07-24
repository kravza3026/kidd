@foreach($results['products'] as $product)
    <x-product-card :product="$product" />
@endforeach

@foreach($results['categories'] as $category)
    <x-category-card :title="$category->name" />
@endforeach
{{--{{ $results['products']->count() }}--}}
{{--{{ $results['categories']->count() }}--}}
