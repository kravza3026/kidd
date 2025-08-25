<?php

return [
    'page_title' => 'Оформление заказа',

    'steps' => [
        'shipping' => 'Детали доставки',
        'contacts' => 'Контактная информация',
        'payment' => 'Платежные реквизиты',
        'review' => 'Просмотр заказа',
    ],

    'summary' => [
        'subtotal' => 'Цена товары',
        'discount' => 'Скидка',
        'shipping' => 'Доставка',
        'total' => 'Итого',
    ],

    'shipping' => [
        'shipping_title' => 'Адрес доставки',

        'form' => [
            'shipping_method' => 'Способ доставки',
            'shipping_methods' => [
                'regular' => [
                    'title' => 'Обычная',
                    'desc' => '3-14 рабочих дней',
                ],
                'gift' => [
                    'title' => 'Подарок',
                    'desc' => '3-7 рабочих дней',
                ],
                'express' => [
                    'title' => 'Экспресс',
                    'desc' => '1-3 рабочих дня',
                ],
            ],

            'shipping_region' => 'Регион',
            'shipping_region_placeholder' => 'Выберите регион',

            'shipping_city' => 'Город',
            'shipping_city_placeholder' => 'Выберите город',

            'shipping_street_name' => 'Улица',
            'shipping_street_name_placeholder' => 'Название улицы',

            'shipping_building' => '№ здания',
            'shipping_building_placeholder' => '№ здания',

            'shipping_postal_code' => 'Почтовый индекс',
            'shipping_postal_code_placeholder' => 'Почтовый индекс',

            'shipping_apartment' => 'Квартира',
            'shipping_apartment_placeholder' => '№ квартиры',

            'shipping_entrance' => 'Подъезд',
            'shipping_entrance_placeholder' => '№ подъезда',

            'shipping_floor' => 'Этаж',
            'shipping_floor_placeholder' => '№ этажа',

            'shipping_intercom' => 'Домофон',
            'shipping_intercom_placeholder' => '№ домофона',

            'saved_addresses_placeholder' => 'Выберите сохраненный адрес',
        ],
    ],

    'contact' => [
        'form' => [
            'first_name' => 'Имя',
            'first_name_placeholder' => 'Введите имя',
            'last_name' => 'Фамилия',
            'last_name_placeholder' => 'Введите фамилию',
            'phone' => 'Телефон',
            'phone_placeholder' => 'Введите номер телефона',
            'email' => 'Электронная почта',
            'email_placeholder' => 'Введите адрес электронной почты',
        ],
    ],

    'continue' => 'Продолжить',
    'shipping_to' => 'с доставкой в',

    'payment' => [
        'form' => [
            'payment_method' => 'Способ оплаты',
            'payment_methods' => [
                'cash_card_at_delivery' => 'Наличные или карта',
                'cash_card_at_delivery_desc' => 'оплата при получении',

                'bank_transfer' => 'Банковский перевод',
                'bank_transfer_desc' => 'для бизнес клиентов',

                'card_online' => 'Онлайн оплата',
                'card_online_desc' => 'Visa или MasterCard',

                'terminal' => 'Платежный терминал',
                'terminal_desc' => 'QIWI, RunPay, итд.',
            ],

            'billing_region' => 'Регион',
            'billing_region_placeholder' => 'Выберите регион',

            'billing_city' => 'Город',
            'billing_city_placeholder' => 'Выберите город',

            'billing_street_name' => 'Улица',
            'billing_street_name_placeholder' => 'Название улицы',

            'billing_building' => '№ здания',
            'billing_building_placeholder' => '№ здания',

            'billing_postal_code' => 'Почтовый индекс',
            'billing_postal_code_placeholder' => 'Почтовый индекс',

            'billing_apartment' => 'Квартира',
            'billing_apartment_placeholder' => '№ квартиры',

            'billing_entrance' => 'Подъезд',
            'billing_entrance_placeholder' => '№ подъезда',

            'billing_floor' => 'Этаж',
            'billing_floor_placeholder' => '№ этажа',

            'billing_intercom' => 'Домофон',
            'billing_intercom_placeholder' => '№ домофона',

            'same_as_shipping' => 'Идентично адресу доставки',
            'saved_addresses_placeholder' => 'Выберите сохраненный адрес',

        ],
    ],

];
