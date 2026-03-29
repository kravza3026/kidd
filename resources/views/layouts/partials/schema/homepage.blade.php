@php
    use App\Support\SchemaMarkup;
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

    $siteUrl = SchemaMarkup::siteUrl();
    $locale = app()->getLocale();
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'ClothingStore',
        '@id' => $siteUrl . '/#store',
        'name' => 'KIDD.',
        'url' => LaravelLocalization::localizeURL('/', $locale),
        'description' => __('seo.general.description', [], $locale),
        'currenciesAccepted' => 'MDL',
        'paymentAccepted' => 'Cash, Credit Card',
        'parentOrganization' => [
            '@id' => $siteUrl . '/#organization',
        ],
        'potentialAction' => [
            '@type' => 'ViewAction',
            'name' => __('menu.catalog', [], $locale),
            'target' => LaravelLocalization::localizeURL(route('products.index'), $locale),
        ],
    ];
@endphp

<script type="application/ld+json">
@json($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)

</script>
