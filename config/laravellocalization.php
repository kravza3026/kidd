<?php

return [
    'supportedLocales' => [
        'ro'    => ['name' => 'Romanian', 'script' => 'Latn', 'native' => 'Română', 'regional' => 'ro_RO',  'flag' => 'icons/flags/fl_ro.svg'],
        'ru'    => ['name' => 'Russian', 'script' => 'Cyrl', 'native' => 'Русский', 'regional' => 'ru_RU',  'flag' => 'icons/flags/fl_ru.svg'],
        'en'    => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB',  'flag' => 'icons/flags/fl_en.svg'],
    ],

    'useAcceptLanguageHeader' => true,

    'hideDefaultLocaleInURL' => false,

    'localesOrder' => [
        'ro', // Romanian
        'ru', // Russian
        'en', // English
    ],

    'localesMapping' => [],

    // Locale suffix for LC_TIME and LC_MONETARY
    // Defaults to most common ".UTF-8". Set to blank on Windows systems, change to ".utf8" on CentOS and similar.
    'utf8suffix' => env('LARAVELLOCALIZATION_UTF8SUFFIX', '.UTF-8'),

    // URLs which should not be processed, e.g. '/nova', '/nova/*', '/nova-api/*' or specific application URLs
    // Defaults to []
    'urlsIgnored' => [],

    'httpMethodsIgnored' => ['POST', 'PUT', 'PATCH', 'DELETE'],
];
