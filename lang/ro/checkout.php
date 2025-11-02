<?php

return [
    'page_title' => 'Comandă',

    'steps' => [
        'shipping' => 'Detalii livrare',
        'shipping_short' => 'Livrare',
        'contacts' => 'Date de contact',
        'contacts_short' => 'Contact',
        'payment' => 'Detalii plată',
        'payment_short' => 'Plată',
        'review' => 'Sumar',
        'review_short' => 'Sumar',
    ],

    'summary' => [
        'sections' => [
            'products' => [
                'title' => 'Produse',
            ],
            'discount' => [
                'title' => 'Cod reducere',
                'not_registered' => [
                    'text' => 'Utilizator nou? <a class="text-olive font-bold" href=":href">Înregistrează-te</a> și primește <span class="font-medium text-olive">:amount%</span> reducere',
                ],
                'code_placeholder' => 'Cod reducere',
                'apply_btn' => 'Aplică',
            ],
            'summary' => [
                'products' => 'Produse',
                'title' => 'Totaluri',
                'subtotal' => 'Produse',
                'discount' => 'Reducere',
                'shipping' => 'Livrare',
                'total' => 'Total',
            ],
            'delivery_discount' => [
                'title' => 'Livrare gratuită',
                'desc' => 'Adaugă bunuri cu valoare de peste :amount lei și beneficiază de livrare gratuită',
                'price' => ':amount lei',
            ],
        ],
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
                'express' => [
                    'title' => 'Expres',
                    'desc' => '1-3 zile lucrătoare',
                    'details' => [
                        'title' => 'Expediere rapidă și convenabilă pentru a vă depăși necesitățile',
                        'description' => 'Comenzile de dimineață pot fi livrate până în seara aceleiași zile. Pentru comenzile plasate după-amiaza, livrarea va fi programată pentru următoarea zi lucrătoare. Acestea sunt intervale de timp aproximative și variază în funcție de volumul comenzilor și de locație.',
                    ],
                ],
                'gift' => [
                    'title' => 'Cadou',
                    'desc' => '3-7 zile lucrătoare',
                    'details' => [
                        'title' => 'Fiecare cadou se simte special și personal cu ambalajul premium',
                        'description' => 'Oferim hârtie de ambalat frumos concepută, panglică și o etichetă personalizată pentru a adăuga în plus
                            o notă specială pentru cadoul tău.<br/><br/>
                            <span class="text-xs opacity-75">*Dimensiunea pachetului va fi aproximativ:
                            <span class="inline-flex w-fit items-center gap-x-1 font-bold">
                                <span class="opacity-60">35cm</span>
                                <span
                                    class="bg-olive inline-flex size-6 items-center justify-center rounded-full text-center text-[10px] text-white"
                                >
                                    L
                                </span>
                            </span>
                            <span class="opacity-35">×</span>
                            <span class="inline-flex w-fit items-center gap-x-1 font-bold">
                                <span class="opacity-60">25cm</span>
                                <span
                                    class="bg-olive inline-flex size-6 items-center justify-center rounded-full text-center text-[10px] text-white"
                                >
                                    W
                                </span>
                            </span>
                            <span class="opacity-35">×</span>
                            <span class="inline-flex w-fit items-center gap-x-1 font-bold">
                                <span class="opacity-60">10cm</span>
                                <span
                                    class="bg-olive inline-flex size-6 items-center justify-center rounded-full text-center text-[10px] text-white"
                                >
                                    H
                                </span>
                            </span></span>',
                    ],
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

            'saved_addresses' => 'Adrese salvate',
            'saved_addresses_placeholder' => 'Alegeți adresa salvată',
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
    'complete_checkout' => 'Finalizează comanda',

    'payment' => [
        'billing_title' => 'Adresă facturare',
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

            'same_as_shipping' => 'Ca adresa livrării',
            'saved_addresses' => 'Adrese salvate',
            'saved_addresses_placeholder' => 'Alegeți adresa salvată',
        ],
    ],

];
