
<div class="max-w-full w-full md:max-w-full lg:max-w-1/2 pb-6 rounded-xl flex-col justify-start items-start inline-flex " >
    <product-page-form :product='@json($product)' size-chart-url="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.footer.size-chart') }}" class="max-w-full w-full min-h-[670px]"></product-page-form>
    @include('.store.pages.product.sections.descriptions')
</div>
