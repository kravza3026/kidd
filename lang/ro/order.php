<?php

return [

    'titles' => [
        'delivery' => 'Detalii livrare',
        'contact' => 'Informații contact',
        'products' => 'Produse',
        'payment' => 'Detalii plată',
    ],

    'table_heading' => [
        'order_number' => 'Nr. Comandă',
        'status' => 'Statut',
        'quantity' => 'Cantitate',
        'placed_at' => 'Data plasării',
        'delivered_at' => 'Data livrării',
        'price' => 'Preț',
    ],

    'table_row' => [
        'order_number' => 'Comandă ',
        'status' => 'Statut',
        'price' => ':price lei',
    ],

    'delivery' => [
        'track_button' => 'Urmărește trimiterea',
        'delivery_method' => 'Tip livrare',
        'delivery_tracking' => 'Cod urmărire',
        'delivery_vendor' => 'Expediat prin',

        'delivery_methods' => [
            'regular' => [
                'title' => 'Regular',
            ],
            'gift' => [
                'title' => 'Cadou',
            ],
            'express' => [
                'title' => 'Expres',
            ],
        ],

        'delivery_region' => 'Regiune',
        'delivery_city' => 'Localitate',
        'delivery_street_name' => 'Strada',
        'delivery_building' => 'Nr. clădire',
        'delivery_postal_code' => 'Cod poștal',
        'delivery_apartment' => 'Apartament',
        'delivery_entrance' => 'Scară',
        'delivery_floor' => 'Etaj',
        'delivery_intercom' => 'Interfon',
    ],

    'contact' => [
        'edit_button' => 'Editează profilul',
        'form' => [
            'first_name' => 'Nume',
            'last_name' => 'Prenume',
            'phone' => 'Telefon',
            'email' => 'E-mail',
        ],
    ],

    'continue' => 'Continuă',

    'payment' => [
        'print_button' => 'Printează factura',
        'download_button' => 'Descarcă factura',

        'first_name' => 'Nume',
        'last_name' => 'Prenume',
        'payment_method' => 'Metoda plății',
        'coupon_code' => 'Reducere utilizată',

        'payment_methods' => [
            'cash_card_at_delivery' => 'Numerar sau Card',
            'bank_transfer' => 'Transfer Bancar',
            'card_online' => 'Plată online',
            'terminal' => 'Terminal de plată',
        ],

        'billing_address' => 'Adresa facturare',
        'billing_region' => 'Regiune',
        'billing_city' => 'Localitate',
        'billing_street_name' => 'Strada',
        'billing_building' => 'Nr. clădire',
        'billing_postal_code' => 'Cod poștal',
        'billing_apartment' => 'Apartament',
        'billing_entrance' => 'Scară',
        'billing_floor' => 'Etaj',
        'billing_intercom' => 'Interfon',
    ],

    'totals' => [
        'subtotal' => 'Preț preliminar',
        'discount' => 'Reducere',
        'shipping' => 'Preț livrare',
        'total' => 'Preț total',
    ],

    'empty' => [
        'title' => 'Nu ai plasat nici o comandă momentan',
        'description' => 'Să găsim ceva drăguț',
        'explore_button' => 'Explorează ținute',
    ],

    'return' => [
        'title' => 'Nu sa potrivit ținuta?',
        'description' => 'Nu sa potrivit ținuta? Poți să ne contactezi în decurs de 14 zile pentru returnare sau schimb!',
        'return_button' => 'Solicită Retur',
    ],

];
