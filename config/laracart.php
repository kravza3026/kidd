<?php

return [

    /*
    |--------------------------------------------------------------------------
    | The caching prefix used to lookup the cart
    |--------------------------------------------------------------------------
    |
    */
    'cache_prefix' => 'kidd_cart',

    /*
    |--------------------------------------------------------------------------
    | database settings
    |--------------------------------------------------------------------------
    |
    | Here you can set the name of the table you want to use for
    | storing and restoring the cart session id.
    |
    */
    'database' => [
        'table' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Locale is used to convert money into a readable format for the user,
    | please note the UTF-8, helps to make sure its encoded correctly
    |
    | Common Locales
    |
    | English - United States (en_US): 123,456.00
    | English - United Kingdom (en_GB) 123,456.00
    | Spanish - Spain (es_ES): 123.456,000
    | Dutch - Netherlands (nl_NL): 123 456,00
    | German - Germany (de_DE): 123.456,00
    | French - France (fr_FR): 123 456,00
    | Italian - Italy (it_IT): 123.456,00
    |
    | This site is pretty useful : http://lh.2xlibre.net/locales/
    |
    |--------------------------------------------------------------------------
    |
    */
    'locale' => 'ro_MD.UTF-8',

    /*
    |--------------------------------------------------------------------------
    | The currency code changes how you see the actual amounts.
    |--------------------------------------------------------------------------
    | This is the list of all valid currency codes
    | https://www2.1010data.com/documentationcenter/prod/1010dataReferenceManual/DataTypesAndFormats/currencyUnitCodes.html
    |
    */
    'currency_code' => 'MDL',

    /*
    |--------------------------------------------------------------------------
    | If true, lets you supply and retrieve all prices in cents.
    | To retrieve the prices as integer in cents, set the $format parameter
    | to false for the various price functions. Otherwise you will retrieve
    | the formatted price instead.
    | Make sure when adding products to the cart, adding coupons, etc, to
    | supply the price in cents too.
    |--------------------------------------------------------------------------
    |
    */
    'prices_in_cents' => true,

    /*
    |--------------------------------------------------------------------------
    | Sets the tax for the cart and items, you can change per item
    | via the object later if needed
    |--------------------------------------------------------------------------
    |
    */
    'tax' => null,

    /*
    |--------------------------------------------------------------------------
    | Allows you to choose if the discounts applied to fees
    |--------------------------------------------------------------------------
    |
    */
    'fees_taxable' => false,

    /*
    |--------------------------------------------------------------------------
    | Allows you to choose if the discounts applied to fees
    |--------------------------------------------------------------------------
    |
    */
    'discount_fees' => false,

    /*
    |--------------------------------------------------------------------------
    | Allows you to configure if a user can apply multiple coupons
    |--------------------------------------------------------------------------
    |
    */
    'multiple_coupons' => false,

    /*
    |--------------------------------------------------------------------------
    | The default item model for your relations
    |--------------------------------------------------------------------------
    |
    */
    'item_model' => \App\Models\ProductVariant::class,

    /*
    |--------------------------------------------------------------------------
    | Binds your data into the correct spots for LaraCart
    |--------------------------------------------------------------------------
    |
    */
    'item_model_bindings' => [
        \LukePOLO\LaraCart\CartItem::ITEM_ID => 'id',
        \LukePOLO\LaraCart\CartItem::ITEM_NAME => 'product.name',
        \LukePOLO\LaraCart\CartItem::ITEM_PRICE => 'price_final',
        \LukePOLO\LaraCart\CartItem::ITEM_TAXABLE => false,
        \LukePOLO\LaraCart\CartItem::ITEM_OPTIONS => [
            'name' => 'product.name',
            'description' => 'product.description',
            'price_online' => 'price_online',
            'price_final' => 'price_final',
            //            'size' => 'size',
            //            'color' => 'color',
            'product' => 'product',
            //            'your_key' => 'price_relation.value', // this will go to the price relation then get the value!
            //            'your_other_key' => 'price_relation.sub_relation.value', // This also works
            // put columns here for additional options,
            // these will be merged with options that are passed in
            // e.x
        ],
    ],

    'free_delivery_after' => 1500, // free delivery after total MDL amount (Without discounts)
    'delivery_price' => 500, // delivery price in MDL

    /*
    |--------------------------------------------------------------------------
    | The default item relations to the item_model
    |--------------------------------------------------------------------------
    |
    */
    'item_model_relations' => [
        'product',
    ],

    /*
    |--------------------------------------------------------------------------
    | This allows you to use multiple devices based on your logged in user
    |--------------------------------------------------------------------------
    |
    */
    'cross_devices' => true,

    /*
    |--------------------------------------------------------------------------
    | This allows you to use custom guard to get logged in user
    |--------------------------------------------------------------------------
    |
    */
    'guard' => null,

    /*
    |--------------------------------------------------------------------------
    | This allows you to exclude any option from generating CartItem hash
    |--------------------------------------------------------------------------
    |
    */
    'exclude_from_hash' => [],
];
