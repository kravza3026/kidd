@php
    use App\Models\Gender;
    use App\Support\SchemaMarkup;

    $productUrl = $product->url;
    $images = SchemaMarkup::productImages($product);
    $visibleVariants = $product->variants->where('is_visible', true);

    $prices = $visibleVariants->pluck('price_final')->filter();
    $lowPrice = $prices->isNotEmpty() ? SchemaMarkup::formatPrice($prices->min()) : null;
    $highPrice = $prices->isNotEmpty() ? SchemaMarkup::formatPrice($prices->max()) : null;
    $anyInStock = $visibleVariants->where('quantity', '>', 0)->isNotEmpty();

    $uniqueColors = $visibleVariants->pluck('color.name')->filter()->unique()->values()->all();

    $genderMap = [
        Gender::UNISEX => 'Unisex',
        Gender::BOY => 'Male',
        Gender::GIRL => 'Female',
    ];
    $suggestedGender = $genderMap[$product->gender_id] ?? null;

    $hasVariantItems = $visibleVariants->map(function ($variant) use ($product, $productUrl) {
        $variantData = [
            '@type' => 'Product',
            'name' => $product->name . ' — ' . ($variant->size?->name ?? ''),
            'sku' => $variant->sku,
            'size' => $variant->size?->name,
            'color' => $variant->color?->name,
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'MDL',
                'price' => SchemaMarkup::formatPrice($variant->price_final),
                'availability' => SchemaMarkup::availability($variant->quantity),
                'itemCondition' => 'https://schema.org/NewCondition',
                'url' => $productUrl,
            ],
        ];

        return $variantData;
    })->values()->all();

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        '@id' => $productUrl . '#product',
        'name' => $product->name,
        'url' => $productUrl,
        'description' => strip_tags($product->description ?? ''),
        'brand' => [
            '@type' => 'Brand',
            'name' => $product->brand?->name ?? 'kidd.',
        ],
        'category' => $product->category?->name,
        'inLanguage' => app()->getLocale(),
    ];

    if ($product->barcode) {
        $schema['sku'] = $product->barcode;
    }

    if ($images) {
        $schema['image'] = $images;
    }

    if ($product->fabric?->name) {
        $schema['material'] = $product->fabric->name;
    }

    if ($uniqueColors) {
        $schema['color'] = count($uniqueColors) === 1 ? $uniqueColors[0] : $uniqueColors;
    }

    if ($suggestedGender) {
        $schema['audience'] = [
            '@type' => 'PeopleAudience',
            'suggestedGender' => $suggestedGender,
        ];
    }

    if ($product->rating > 0 && $product->review_count > 0) {
        $schema['aggregateRating'] = [
            '@type' => 'AggregateRating',
            'ratingValue' => $product->rating,
            'reviewCount' => $product->review_count,
        ];
    }

    if ($hasVariantItems) {
        $schema['hasVariant'] = $hasVariantItems;
    }

    if ($lowPrice !== null) {
        $schema['offers'] = [
            '@type' => 'AggregateOffer',
            'priceCurrency' => 'MDL',
            'lowPrice' => $lowPrice,
            'highPrice' => $highPrice,
            'offerCount' => $visibleVariants->count(),
            'availability' => $anyInStock ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
        ];
    }
@endphp

<script type="application/ld+json">
@json($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
</script>
