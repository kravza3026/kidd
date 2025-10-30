<?php

return [
    'account_title' => 'My account',
    'nav_profile' => 'Profile',
    'nav_favorites' => 'Favorites',
    'nav_orders' => 'Orders',
    'nav_addresses' => 'Addresses',

    'profile' => [
        'general' => [
            'title' => 'General information',
            'form' => [
                'first_name' => 'First name',
                'last_name' => 'Last name',
                'phone' => 'Phone number',
                'phone_unverified' => 'Phone number is not verified',
                'phone_resend' => 'Click to resend confirmation code',
                'email' => 'E-mail',
                'email_unverified' => 'Email is not verified',
                'email_resend' => 'Click to resend confirmation',
                'password' => 'Password',
                'password_confirmation' => 'Password confirmation',
            ],
            'btn_save' => 'Save changes',
        ],
        'family' => [
            'title' => 'My Family filters',
            'description' => 'Filter clothing by predefined profiles of your children',
            'form' => [
                'btn_add_member' => '+ Add child',
            ],
        ],
        'marketing' => [
            'title' => 'Marketing preferences',
            'description' => 'Get news and offers',
            'form' => [
                'newsletter' => 'News and offers by e-mail',
                'email_new_order' => 'New order details by e-mail',
                'sms_new_order' => 'New order details by SMS',
                'email_order_updates' => 'Order status updates by e-mail',
                'sms_order_updates' => 'Order status updates by SMS',
            ],
            'btn_save' => 'Save changes',
        ],
    ],
];
