<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Uri;

class SchemaMarkup
{
    /**
     * Format a price stored as integer cents to a decimal string for schema.org.
     */
    public static function formatPrice(int $cents): string
    {
        return number_format($cents / 100, 2, '.', '');
    }

    /**
     * Return the schema.org availability URL based on stock quantity.
     */
    public static function availability(int $quantity): string
    {
        return $quantity > 0
            ? 'https://schema.org/InStock'
            : 'https://schema.org/OutOfStock';
    }

    /**
     * Return the canonical site URL.
     */
    public static function siteUrl(): string
    {
        return rtrim(config('app.url'), '/');
    }

    /**
     * Return the api URL.
     */
    public static function apiUrl(): string
    {
        return Uri::of('http://'.config('app.api_url'))
            ->withScheme('https')
            ->withPath('/v1');

    }

    /**
     * Extract full-conversion image URLs from a product's gallery media collection.
     *
     * @return array<int, string>
     */
    public static function productImages(Product $product): array
    {
        $media = $product->getMedia('gallery');

        if ($media->isEmpty()) {
            return [];
        }

        return $media->map(fn ($item) => $item->getUrl('full'))->values()->all();
    }
}
