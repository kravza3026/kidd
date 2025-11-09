<?php

return [
    'page_title' => 'Checkout',

    'steps' => [
        'shipping' => 'Shipping details',
        'shipping_short' => 'Shipping',
        'contacts' => 'Contact information',
        'contacts_short' => 'Contact',
        'payment' => 'Payment details',
        'payment_short' => 'Payment',
        'review' => 'Order review',
        'review_short' => 'Review',
    ],

    'summary' => [
        'sections' => [
            'products' => [
                'title' => 'Products',
            ],
            'discount' => [
                'title' => 'Discount code',
                'not_registered' => [
                    'text' => 'New customer? <a class="text-olive font-bold" href=":href">Sign Up</a> to get <span class="font-medium text-olive">:amount%</span> discount.',
                ],
                'code_placeholder' => 'Enter code',
                'apply_btn' => 'Apply',
            ],
            'summary' => [
                'products' => 'Products',
                'title' => 'Order summary',
                'subtotal' => 'Products',
                'discount' => 'Discount',
                'shipping' => 'Shipment cost',
                'total' => 'Grand total',
            ],
            'delivery_discount' => [
                'title' => 'Discount on delivery cost',
                'desc' => 'Add goods worth more than :amount mdl and get discount on delivery',
                'price' => ':amount mdl',
            ],
        ],
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
                'express' => [
                    'title' => 'Express',
                    'desc' => '1-3 business days',
                    'details' => [
                        'title' => 'Fast and convenient shipping services to exceed your needs',
                        'description' => 'Morning orders can be delivered by the evening of the same day. For orders placed in the afternoon, delivery will be scheduled for the next business day. Please note that these are approximate time frames and vary based on order volume and location.',
                    ],
                ],
                'gift' => [
                    'title' => 'Gift',
                    'desc' => '3-7 business days',
                    'details' => [
                        'title' => 'Make every gift feel special and personal with gift wrapping',
                        'description' => 'We offer beautifully designed wrapping paper, ribbon and a personalised tag to add an extra special touch to your gift. <br/><br/>
                            <span class="text-xs opacity-75">*Package size will be approximately:
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
            'shipping_apartment_placeholder' => 'Apartment #',

            'shipping_entrance' => 'Entrance',
            'shipping_entrance_placeholder' => 'Entrance',

            'shipping_floor' => 'Floor',
            'shipping_floor_placeholder' => 'Floor',

            'shipping_intercom' => 'Intercom',
            'shipping_intercom_placeholder' => 'Intercom',

            'saved_addresses' => 'Saved addresses',
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
    'complete_checkout' => 'Finish order',

    'payment' => [
        'billing_title' => 'Billing address',
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

            'same_as_shipping' => 'Same as shipping',
            'saved_addresses' => 'Saved addresses',
            'saved_addresses_placeholder' => 'Select saved address',
        ],
    ],

];
