<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Routes Translation Lines
    |--------------------------------------------------------------------------
    */

    'topline' => [
        'locations' => 'locatii-magazine',
        'careers' => [
            'careers' => 'cariere',
            'vacancy' => [
                'vacancy' => 'cariere/{vacancy}',
                'create' => 'cariere/{vacancy}/aplica'
            ]
        ],
        'terms' => 'termeni-si-conditii',
    ],

    'menu' => [
        'catalog' => 'catalog',
        'about' => 'despre-noi',
        'help' => 'ajutor',
        'contacts' => 'contacte',
    ],

    'catalog' => [
        '{category}' => 'catalog/{category}',
        '{category}/{product}' => 'catalog/{category}/{product}',
    ],

];
