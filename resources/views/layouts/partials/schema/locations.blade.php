@php
    use App\Models\Location;
    use App\Support\SchemaMarkup;

    $siteUrl = SchemaMarkup::siteUrl();
    $stores = $locations->where('type', Location::TYPE_STORE);
@endphp

@foreach($stores as $store)
@php
    $geo = $store->geo_position;
    $lat = is_array($geo) ? ($geo['lat'] ?? ($geo[0] ?? null)) : null;
    $lng = is_array($geo) ? ($geo['lng'] ?? ($geo[1] ?? null)) : null;

    $address = $store->address;

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'ClothingStore',
        'name' => $store->name ?? 'kidd.',
        'url' => route('locations'),
        'parentOrganization' => [
            '@id' => $siteUrl . '/#organization',
        ],
    ];

    if ($address) {
        $postalAddress = [
            '@type' => 'PostalAddress',
            'addressCountry' => 'MD',
        ];

        if ($address->street_name) {
            $streetAddress = $address->street_name;
            if ($address->building) {
                $streetAddress .= ' ' . $address->building;
            }
            $postalAddress['streetAddress'] = $streetAddress;
        }

        if ($address->city) {
            $postalAddress['addressLocality'] = $address->city->name ?? null;
        }

        if ($address->region) {
            $postalAddress['addressRegion'] = $address->region->name ?? null;
        }

        if ($address->postal_code) {
            $postalAddress['postalCode'] = $address->postal_code;
        }

        $schema['address'] = array_filter($postalAddress);
    }

    if ($lat !== null && $lng !== null) {
        $schema['geo'] = [
            '@type' => 'GeoCoordinates',
            'latitude' => $lat,
            'longitude' => $lng,
        ];
    }

    if ($store->open_hours) {
        $schema['openingHours'] = $store->open_hours;
    }
@endphp

<script type="application/ld+json">
@json($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
</script>
@endforeach
