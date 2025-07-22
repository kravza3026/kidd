
<div class="container pb-6 px-10 rounded-xl flex-col justify-start items-start inline-flex">
    <div data-vue-component="ProductPageForm"
         data-product='@json($product)'
         data-locale='{{app()->getLocale()}}'
         data-link='{{ $product->link() }}'

    ></div>
    @include('.store.pages.product.sections.descriptions')
</div>
