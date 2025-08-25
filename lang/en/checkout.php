<?php

return [
    'page_title' => 'Checkout',

    'steps' => [
        'shipping' => 'Shipping details',
        'contacts' => 'Contact information',
        'payment' => 'Payment details',
        'review' => 'Order review',
    ],

    'summary' => [
        'subtotal' => 'Products',
        'discount' => 'Discount',
        'shipping' => 'Delivery',
        'total' => 'Total',
    ],

    'shipping' => [
        'shipping_title' => 'Delivery address',

        'form' => [
            'shipping_method' => 'Shipping method',
            'shipping_methods' => [
                'regular' => [
                    'title' => 'Regular',
                    'desc' => '3-14 business days',
                ],
                'gift' => [
                    'title' => 'Gift',
                    'desc' => '3-7 business days',
                ],
                'express' => [
                    'title' => 'Express',
                    'desc' => '1-3 business days',
                ],
            ],

            'shipping_region' => 'Region',
            'shipping_region_placeholder' => 'Select region',

            'shipping_city' => 'Locality',
            'shipping_city_placeholder' => 'Select locality',

            'shipping_street_name' => 'Street',
            'shipping_street_name_placeholder' => 'Street name',

            'shipping_building' => 'Building',
            'shipping_building_placeholder' => 'Building #',

            'shipping_postal_code' => 'Postal code',
            'shipping_postal_code_placeholder' => 'Postal code',

            'shipping_apartment' => 'Apartment',
            'shipping_apartment_placeholder' => 'Apartment number',

            'shipping_entrance' => 'Entrance',
            'shipping_entrance_placeholder' => 'Entrance',

            'shipping_floor' => 'Floor',
            'shipping_floor_placeholder' => 'Floor',

            'shipping_intercom' => 'Intercom',
            'shipping_intercom_placeholder' => 'Intercom',

            'saved_addresses_placeholder' => 'Select saved address',
        ],
    ],

    'contact' => [
        'form' => [
            'first_name' => 'First name',
            'first_name_placeholder' => 'Enter your first name',
            'last_name' => 'Last name',
            'last_name_placeholder' => 'Enter your last name',
            'phone' => 'Phone',
            'phone_placeholder' => 'Enter phone number',
            'email' => 'Email',
            'email_placeholder' => 'Enter email address',
        ],
    ],

    'continue' => 'Continue',
    'shipping_to' => 'shipping to',

    'payment' => [
        'form' => [
            'payment_method' => 'Payment method',
            'payment_methods' => [
                'cash_card_at_delivery' => 'Cash or Card',
                'cash_card_at_delivery_desc' => 'at the delivery',

                'bank_transfer' => 'Bank Transfer',
                'bank_transfer_desc' => 'for business clients',

                'card_online' => 'Online Payment',
                'card_online_desc' => 'Visa or MasterCard',

                'terminal' => 'Payment Terminal',
                'terminal_desc' => 'QIWI, RunPay, etc.',
            ],

            'billing_region' => 'Region',
            'billing_region_placeholder' => 'Select region',

            'billing_city' => 'Locality',
            'billing_city_placeholder' => 'Select locality',

            'billing_street_name' => 'Street',
            'billing_street_name_placeholder' => 'Street name',

            'billing_building' => 'Building',
            'billing_building_placeholder' => 'Building #',

            'billing_postal_code' => 'Postal code',
            'billing_postal_code_placeholder' => 'Postal code',

            'billing_apartment' => 'Apartment',
            'billing_apartment_placeholder' => 'Apartment number',

            'billing_entrance' => 'Entrance',
            'billing_entrance_placeholder' => 'Entrance',

            'billing_floor' => 'Floor',
            'billing_floor_placeholder' => 'Floor',

            'billing_intercom' => 'Intercom',
            'billing_intercom_placeholder' => 'Intercom',

            'same_as_shipping' => 'Same as shipping address',
            'saved_addresses_placeholder' => 'Select saved address',
        ],
    ],

];
