
<div class="max-w-full lg:max-w-1/2 pb-6 rounded-xl flex-col justify-start items-start inline-flex">
    <div data-vue-component="ProductPageForm"
         data-product='@json($product)'
         data-locale='{{app()->getLocale()}}'
         data-link='{{ $product->link() }}'
         class="max-w-full"
    ></div>
    @include('.store.pages.product.sections.descriptions')
</div>
