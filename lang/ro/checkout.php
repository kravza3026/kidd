<?php

return [
    'page_title' => 'Finalizare Comandă',

    'steps' => [
        'shipping' => 'Detalii livrare',
        'contacts' => 'Date de contact',
        'payment' => 'Detalii plată',
        'review' => 'Revizuire comandă',
    ],

    'summary' => [
        'subtotal' => 'Produse',
        'discount' => 'Reducere',
        'shipping' => 'Livrare',
        'total' => 'Total',
    ],

    'shipping' => [
        'shipping_title' => 'Adresă livrare',

        'form' => [
            'shipping_method' => 'Metoda livrării',
            'shipping_methods' => [
                'regular' => [
                    'title' => 'Regular',
                    'desc' => '3-14 zile lucrătoare',
                ],
                'gift' => [
                    'title' => 'Cadou',
                    'desc' => '3-7 zile lucrătoare',
                ],
                'express' => [
                    'title' => 'Expres',
                    'desc' => '1-3 zile lucrătoare',
                ],
            ],

            'shipping_region' => 'Regiune',
            'shipping_region_placeholder' => 'Selectați regiunea',

            'shipping_city' => 'Localitate',
            'shipping_city_placeholder' => 'Selectați localitatea',

            'shipping_street_name' => 'Strada',
            'shipping_street_name_placeholder' => 'Denumirea strada',

            'shipping_building' => 'Nr. clădire',
            'shipping_building_placeholder' => 'Nr. clădirii',

            'shipping_postal_code' => 'Cod poștal',
            'shipping_postal_code_placeholder' => 'Cod poștal',

            'shipping_apartment' => 'Apartament',
            'shipping_apartment_placeholder' => 'Nr. apartament',

            'shipping_entrance' => 'Scară',
            'shipping_entrance_placeholder' => 'Nr. scării',

            'shipping_floor' => 'Etaj',
            'shipping_floor_placeholder' => 'Nr. etaj',

            'shipping_intercom' => 'Interfon',
            'shipping_intercom_placeholder' => 'Nr. interfon',

            'saved_addresses_placeholder' => 'Alegeți adresă salvată',
        ],
    ],

    'contact' => [
        'form' => [
            'first_name' => 'Nume',
            'first_name_placeholder' => 'Introduceți numele',
            'last_name' => 'Prenume',
            'last_name_placeholder' => 'Introduceți prenumele',
            'phone' => 'Telefon',
            'phone_placeholder' => 'Introduceți numărul de telefon',
            'email' => 'E-mail',
            'email_placeholder' => 'Introduceți e-mailul',
        ],
    ],

    'continue' => 'Continuă',
    'shipping_to' => 'cu livrare la',

    'payment' => [
        'form' => [
            'payment_method' => 'Metoda plății',
            'payment_methods' => [
                'cash_card_at_delivery' => 'Numerar sau Card',
                'cash_card_at_delivery_desc' => 'la livrare',

                'bank_transfer' => 'Transfer Bancar',
                'bank_transfer_desc' => 'pentru clienți business',

                'card_online' => 'Plată online',
                'card_online_desc' => 'Visa sau MasterCard',

                'terminal' => 'Terminal de plată',
                'terminal_desc' => 'QIWI, RunPay, etc.',
            ],

            'billing_region' => 'Regiune',
            'billing_region_placeholder' => 'Selectați regiunea',

            'billing_city' => 'Localitate',
            'billing_city_placeholder' => 'Selectați localitatea',

            'billing_street_name' => 'Strada',
            'billing_street_name_placeholder' => 'Denumirea strada',

            'billing_building' => 'Nr. clădire',
            'billing_building_placeholder' => 'Nr. clădirii',

            'billing_postal_code' => 'Cod poștal',
            'billing_postal_code_placeholder' => 'Cod poștal',

            'billing_apartment' => 'Apartament',
            'billing_apartment_placeholder' => 'Nr. apartament',

            'billing_entrance' => 'Scară',
            'billing_entrance_placeholder' => 'Nr. scării',

            'billing_floor' => 'Etaj',
            'billing_floor_placeholder' => 'Nr. etaj',

            'billing_intercom' => 'Interfon',
            'billing_intercom_placeholder' => 'Nr. interfon',

            'same_as_shipping' => 'La fel ca adresa livrării',
            'saved_addresses_placeholder' => 'Alegeți adresă salvată',
        ],
    ],

];
