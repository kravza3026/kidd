<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'google_maps' => [
        'key' => env('GOOGLE_MAPS_API_KEY', 'AIzaSyDrkYdFS2g0CovDZhGrBdvKzDitK34BgY0'),
    ],

    'ga4' => [
        'measurement_id' => env('GA4_MEASUREMENT_ID', 'G-2PGQD62044'),
        'api_secret' => env('GA4_API_SECRET'),
    ],

    'gtag' => [
        'id' => env('GTAG_ID', 'GTM-M8KLG54J'),
    ],

    'fb_pixel' => [
        'pixel_id' => env('FB_PIXEL_ID', '2308317899361524'),
        'access_token' => env('FB_PIXEL_ACCESS_TOKEN'),
    ],

    'social_links' => [
        'facebook' => env('SOCIAL_LINKS_FACEBOOK', 'https://facebook.com/kidd.moldova'),
        'instagram' => env('SOCIAL_LINKS_INSTAGRAM', 'https://instagram.com/kidd.moldova'),
        'messenger' => env('SOCIAL_LINKS_MESSENGER', 'https://m.me/kidd.moldova'),
        'youtube' => env('SOCIAL_LINKS_YOUTUBE', 'https://youtube.com/'),
        'tiktok' => env('SOCIAL_LINKS_TIKTOK', 'https://tiktok.com/'),
    ],

];
