@php
    use App\Support\SchemaMarkup;

    $siteUrl = SchemaMarkup::siteUrl();
    $apiUrl = SchemaMarkup::apiUrl();

    $socialLinks = config('services.social_links');

    $sameAs = array_values(array_filter([
        $socialLinks['facebook'] ?? null,
        $socialLinks['instagram'] ?? null,
        $socialLinks['tiktok'] ?? null,
        $socialLinks['youtube'] ?? null,
    ]));

    $organization = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        '@id' => $siteUrl . '/#organization',
        'name' => 'KIDD.',
        'url' => $siteUrl,
        'logo' => [
            '@type' => 'ImageObject',
            'url' => asset('assets/images/logo.svg'),
        ],
        'sameAs' => $sameAs,
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'contactType' => 'Customer Service',
            'availableLanguage' => ['Romanian', 'Russian', 'English'],
        ],
    ];

    $website = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => $siteUrl . '/#website',
        'name' => 'KIDD.',
        'url' => $siteUrl,
        'publisher' => [
            '@id' => $siteUrl . '/#organization',
        ],
        'inLanguage' => ['ro', 'ru', 'en'],
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => $apiUrl . '/search?term={search_term_string}',
            ],
            'query-input' => 'required name=search_term_string',
        ],
    ];

@endphp

<script type="application/ld+json">
@json($organization, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
</script>

<script type="application/ld+json">
@json($website, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
</script>
