<?php

return [
    'page_title' => 'Заказ',

    'steps' => [
        'shipping' => 'Детали доставки',
        'shipping_short' => 'Доставка',
        'contacts' => 'Контактная информация',
        'contacts_short' => 'Контакты',
        'payment' => 'Детали оплаты',
        'payment_short' => 'Оплата',
        'review' => 'Просмотр заказа',
        'review_short' => 'Итог',
    ],

    'summary' => [
        'sections' => [
            'products' => [
                'title' => 'Товары',
            ],
            'discount' => [
                'title' => 'Скидка',
                'not_registered' => [
                    'text' => 'Utilizator nou? <a class="text-olive font-bold" href=":href">Înregistrează-te</a> și primește <span class="font-medium text-olive">:amount%</span> reducere',
                ],
                'code_placeholder' => 'Скидочный код',
                'apply_btn' => 'Применить',
            ],
            'summary' => [
                'products' => 'Товары',
                'title' => 'Итоги',
                'subtotal' => 'Товары',
                'discount' => 'Скидка',
                'shipping' => 'Доставка',
                'total' => 'Итого',
            ],
            'delivery_discount' => [
                'title' => 'Бесплатная доставка',
                'desc' => 'Добавьте товаров на сумму больше :amount лей и получите бесплатную доставку',
                'price' => ':amount лей',
            ],
        ],
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
                'express' => [
                    'title' => 'Экспресс',
                    'desc' => '1-3 рабочих дня',
                    'details' => [
                        'title' => 'Быстрая и удобная доставка превзойдет ваши потребности',
                        'description' => 'Утренние заказы могут быть доставлены к вечеру того же дня. Для заказов, размещенных во второй половине дня, доставка будет запланирована на следующий рабочий день. Обратите внимание, что это приблизительные временные рамки, которые варьируются в зависимости от объема и местоположения заказа.',
                    ],
                ],
                'gift' => [
                    'title' => 'Подарок',
                    'desc' => '3-7 рабочих дней',
                    'details' => [
                        'title' => 'Сделайте каждый подарок особенным и уникальным с нашей подарочной упаковки',
                        'description' => 'Мы предлагаем красиво оформленную упаковочную бумагу, ленту и персонализированную бирку, чтобы придать вашему подарку особый штрих. <br/><br/>
                            <span class="text-xs opacity-75">*Размер упаковки будет приблизительно:
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

            'saved_addresses' => 'Сохранённые адреса',
            'saved_addresses_placeholder' => 'Выбрать сохранённый',
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
    'complete_checkout' => 'Оформить заказ',

    'payment' => [
        'billing_title' => 'Адрес счёта',
        'form' => [
            'payment_method' => 'Способ оплаты',
            'payment_methods' => [
                'cash_card_at_delivery' => 'Наличные или карта',
                'cash_card_at_delivery_desc' => 'при получении',

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

            'same_as_shipping' => 'Как адрес доставки',
            'saved_addresses' => 'Сохранённые адреса',
            'saved_addresses_placeholder' => 'Выбрать сохранённый адрес',

        ],
    ],

];
