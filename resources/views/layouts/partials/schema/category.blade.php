@php
    use App\Support\SchemaMarkup;
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

    $locale = app()->getLocale();
    $siteUrl = SchemaMarkup::siteUrl();

    $categoryUrl = $category->exists
        ? LaravelLocalization::localizeURL(route('products.category.index', $category), $locale)
        : LaravelLocalization::localizeURL(route('products.index'), $locale);

    $itemListElements = $products->map(function ($product, $index) use ($products) {
        $position = ($products->firstItem() ?? 1) + $index;

        return [
            '@type' => 'ListItem',
            'position' => $position,
            'url' => $product->url,
            'name' => $product->name,
        ];
    })->values()->all();

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        '@id' => $categoryUrl . '#webpage',
        'url' => $categoryUrl,
        'name' => ($category->exists ? $category->name : __('general.products')) . ' — kidd.',
        'inLanguage' => $locale,
        'numberOfItems' => $products->total(),
        'isPartOf' => [
            '@id' => $siteUrl . '/#website',
        ],
    ];

    if ($category->exists && $category->description) {
        $schema['description'] = strip_tags($category->description);
    }

    if ($itemListElements) {
        $schema['mainEntity'] = [
            '@type' => 'ItemList',
            'itemListElement' => $itemListElements,
        ];
    }
@endphp

<script type="application/ld+json">
@json($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
</script>
