<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Routes Translation Lines
    |--------------------------------------------------------------------------
    */

    'topline' => [
        'locations' => 'pick-up-locations',
        'careers' => [
            'careers' => 'careers',
            'vacancy' => [
                'vacancy' => 'careers/{vacancy}',
                'create' => 'careers/{vacancy}/apply'
            ]
        ],
        'terms' => 'terms-and-conditions',
    ],

    'menu' => [
        'catalog' => 'catalog',
        'about' => 'about-us',
        'help' => 'help',
        'contacts' => 'contacts',
    ],

    'catalog' => [
        '{category}' => 'catalog/{category}',
        '{category}/{product}' => 'catalog/{category}/{product}',
    ],

];
