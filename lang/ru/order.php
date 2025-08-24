<?php

return [

    'titles' => [
        'delivery' => 'Детали доставки',
        'contact' => 'Контактные данные',
        'products' => 'Товары',
        'payment' => 'Детали оплаты',
    ],

    'table_heading' => [
        'order_number' => '№ заказа',
        'status' => 'Статус',
        'quantity' => 'Кол-во',
        'placed_at' => 'Дата заказа',
        'delivered_at' => 'Дата доставки',
        'price' => 'Цена',
    ],

    'table_row' => [
        'order_number' => 'Заказ ',
        'status' => 'Статус',
        'price' => ':price лей',
    ],

    'delivery' => [
        'track_button' => 'Отследить посылку',
        'delivery_method' => 'Тип доставки',
        'delivery_tracking' => 'Код отслеживания',
        'delivery_vendor' => 'Отправлено через',

        'delivery_methods' => [
            'regular' => [
                'title' => 'Обычная',
            ],
            'gift' => [
                'title' => 'Подарок',
            ],
            'express' => [
                'title' => 'Экспресс',
            ],
        ],

        'delivery_region' => 'Регион',
        'delivery_city' => 'Город',
        'delivery_street_name' => 'Улица',
        'delivery_building' => '№ дома',
        'delivery_postal_code' => 'Почтовый индекс',
        'delivery_apartment' => 'Квартира',
        'delivery_entrance' => 'Подъезд',
        'delivery_floor' => 'Этаж',
        'delivery_intercom' => 'Домофон',
    ],

    'contact' => [
        'edit_button' => 'Редактировать профиль',
        'form' => [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'phone' => 'Телефон',
            'email' => 'Электронная почта',
        ],
    ],

    'continue' => 'Продолжить',

    'payment' => [
        'print_button' => 'Распечатать счёт',
        'download_button' => 'Скачать счёт',

        'first_name' => 'Имя',
        'last_name' => 'Фамилия',
        'payment_method' => 'Способ оплаты',
        'coupon_code' => 'Промокод',

        'payment_methods' => [
            'cash_card_at_delivery' => 'Наличные или карта',
            'bank_transfer' => 'Банковский перевод',
            'card_online' => 'Онлайн оплата',
            'terminal' => 'Платёжный терминал',
        ],

        'billing_address' => 'Адрес для выставления счета',
        'billing_region' => 'Регион',
        'billing_city' => 'Город',
        'billing_street_name' => 'Улица',
        'billing_building' => '№ дома',
        'billing_postal_code' => 'Почтовый индекс',
        'billing_apartment' => 'Квартира',
        'billing_entrance' => 'Подъезд',
        'billing_floor' => 'Этаж',
        'billing_intercom' => 'Домофон',
    ],

    'totals' => [
        'subtotal' => 'Промежуточный итог',
        'discount' => 'Скидка',
        'shipping' => 'Цена доставки',
        'total' => 'Итого',
    ],

    'empty' => [
        'title' => 'Похоже, ты ещё не делал заказов',
        'description' => 'Давай найдём что-нибудь милое!',
        'explore_button' => 'Смотреть каталог',
    ],

    'return' => [
        'title' => 'Не подошла одежда?',
        'description' => 'Не подошла одежда? Свяжись с нами в течение 14 дней для возврата или обмена!',
        'return_button' => 'Запросить возврат',
    ],

];
