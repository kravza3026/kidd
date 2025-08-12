<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => [
        'v1/*',
        'sanctum/csrf-cookie'
    ],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
//        'https://kidd.md',
//        'https://api.kidd.md',
//        'https://cp.kidd.md',

        'http://kidd.test', // TODO Remove on production
        'https://kidd.test',
        'http://api.kidd.test',  // API HTTP
        'https://api.kidd.test', // API HTTPS
    ],

    'allowed_origins_patterns' => [
//        '^https?://.*\.kidd\.md',
//        '^https?://.*\.kidd\.test$',
    ],

    'allowed_headers' => ['*'],

    'exposed_headers' => ['Precognition', 'Precognition-Success', 'Precognition-Error'],

    'max_age' => 0,

    'supports_credentials' => true,

];
