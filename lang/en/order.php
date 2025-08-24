<?php

return [

    'titles' => [
        'delivery' => 'Delivery details',
        'contact' => 'Contact info',
        'products' => 'Products',
        'payment' => 'Payment details',
    ],

    'table_heading' => [
        'order_number' => 'Order ID',
        'status' => 'Status',
        'quantity' => 'Items',
        'placed_at' => 'Date placed',
        'delivered_at' => 'Date delivered',
        'price' => 'Price',
    ],

    'table_row' => [
        'order_number' => 'Order ',
        'status' => 'Status',
        'price' => ':price mdl',
    ],

    'delivery' => [
        'track_button' => 'Track order',
        'delivery_method' => 'Delivery method',
        'delivery_tracking' => 'Tracking code',
        'delivery_vendor' => 'Sent with',

        'delivery_methods' => [
            'regular' => [
                'title' => 'Regular',
            ],
            'gift' => [
                'title' => 'Gift',
            ],
            'express' => [
                'title' => 'Express',
            ],
        ],

        'delivery_region' => 'Region',
        'delivery_city' => 'Locality',
        'delivery_street_name' => 'Street',
        'delivery_building' => 'Building',
        'delivery_postal_code' => 'Postal code',
        'delivery_apartment' => 'Apartment',
        'delivery_entrance' => 'Entrance',
        'delivery_floor' => 'Floor',
        'delivery_intercom' => 'Intercom',
    ],

    'contact' => [
        'edit_button' => 'Edit profile',
        'form' => [
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'phone' => 'Phone number',
            'email' => 'E-mail address',
        ],
    ],

    'continue' => 'Continue',

    'payment' => [
        'print_button' => 'Print invoice',
        'download_button' => 'Download invoice',

        'first_name' => 'First name',
        'last_name' => 'Last name',
        'payment_method' => 'Payment method',
        'coupon_code' => 'Used coupon',

        'payment_methods' => [
            'cash_card_at_delivery' => 'Cash or Card',
            'bank_transfer' => 'Bank Transfer',
            'card_online' => 'Online payment',
            'terminal' => 'Payment Terminal',
        ],

        'billing_address' => 'Invoice address',
        'billing_region' => 'Region',
        'billing_city' => 'Locality',
        'billing_street_name' => 'Street',
        'billing_building' => 'Building',
        'billing_postal_code' => 'Postal code',
        'billing_apartment' => 'Apartment',
        'billing_entrance' => 'Entrance',
        'billing_floor' => 'Floor',
        'billing_intercom' => 'Intercom',
    ],

    'totals' => [
        'subtotal' => 'Subtotal price',
        'discount' => 'Discount amount',
        'shipping' => 'Delivery price',
        'total' => 'Total price',
    ],

    'empty' => [
        'title' => 'You have no orders',
        'description' => 'Let\'s find something cute',
        'explore_button' => 'Explore outfits',
    ],

    'return' => [
        'title' => 'Product doesn\'t match of fit?',
        'description' => 'Product doesn\'t match of fit? You can contact us for return within 14 days of receiving it!',
        'return_button' => 'Ask for return',
    ],

];
