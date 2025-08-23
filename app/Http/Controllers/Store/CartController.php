<?php

namespace App\Http\Controllers\Store;

use App\Coupons\FreeDeliveryCoupon;
use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use LukePOLO\LaraCart\Coupons\Fixed;
use LukePOLO\LaraCart\Coupons\Percentage;
use LukePOLO\LaraCart\Facades\LaraCart;

class CartController extends Controller
{
    public function index()
    {

        //        $cart = LaraCart::setInstance('default');
        //        $cart = $cart->cart;
        //        LaraCart::emptyCart();
        //        dd($cart);
        //                LaraCart::destroyCart();

        //        $product = Product::findOrFail(123);
        //        $variants = $product->variants;
        //
        //                $item = LaraCart::add(
        //                    $variants->last(),
        //                    rand(1, 10),
        //                );
        //
        // //         Adding an item to the cart
        //                $item = LaraCart::addLine(
        //                    itemID: $variants->last(),
        //                    qty: 1,
        //                    taxable: true,
        //                );
        //
        //                $item->addSubItem([
        //                    'description' => 'Express Delivery', // this line is not required!
        //                    'price' => 15000,
        //                    'taxable' => false,
        //                    'qty' => 1,
        //                ]);

        $coupons[] = new Percentage('SUMMER10', '0.1', [
            'description' => '10% Discount',
            'taxable' => false,
        ]);

        //        $coupons[] = new Fixed('test_fixed', 10000,[
        //            'description' => '100 MDL reducere',
        //            'taxable' => false,
        //        ]);

        //        $coupons[] = new FreeDeliveryCoupon('free_delivery', 10000, [
        //            'description' => 'Livrare gratuită',
        //            'taxable' => false,
        //        ]);

        foreach ($coupons as $coupon) {
            LaraCart::addCoupon($coupon);
        }
        //                LaraCart::removeCoupon('SUMMER10');
        //        LaraCart::removeCoupon('free_delivery');
        //                LaraCart::removeCoupon('test_fixed');

        //        LaraCart::addFee('delivery', (50 * 100), $taxable = false, $options = ['description' => 'Delivery fee']);
        //        LaraCart::addFee('free_delivery', (-50 * 100), $taxable = false, $options = ['description' => 'Free delivery']);

        //        LaraCart::addFee('gift', 300 * 100, $taxable = false, $options = ['description' => 'Gift wrap']);
        //        LaraCart::addFee('express_delivery', 100 * 100, $taxable = false, $options = ['description' => 'Express delivery']);
        //        LaraCart::addFee('free_express_delivery', -150 * 100, $taxable = false, $options = ['description' => 'Free Express delivery promo']);

        //        LaraCart::removeFee('gift');
        //                LaraCart::removeFee('express_delivery');
        //        LaraCart::removeFee('free_express_delivery');

        //        $items = LaraCart::getItems();
        //        foreach ($items as $item) {
        //            $item->name = $item->model->product->name;
        //            $item->description = $item->model->product->description;
        //            dump($item);
        //            dump($item->total());
        //            dump($item->price / 100);
        //        }

        //        dump($items);
        //        dump(LaraCart::getFees());
        //        dump(LaraCart::getCoupons());
        //
        //        dump('Net Total: '.LaraCart::netTotal($formatted = true, $withDiscount = true));
        //        dump('Items Total: '.LaraCart::itemTotals($formatted = true, $withDiscount = true));
        //
        //        dump('Fees: '.LaraCart::feeSubTotal($formatted = true, $withDiscount = true));
        //        dump('Discount: '.LaraCart::discountTotal($formatted = true, $withDiscount = true));
        //        dump('Sub Total: '.LaraCart::subTotal($formatted = true, $withDiscount = true));
        //        dump('Total: '.LaraCart::total($formatted = true, $withDiscount = true));

        //        netTotal
        //        itemTotals

        //        dd(LaraCart::total($formatted = false) / 100); // $24.23 | USD 24.23 LaraCart::total();

        return view('store.cart.index', [
            'items' => LaraCart::getItems(),
            'fees' => LaraCart::getFees(),
            'coupons' => LaraCart::getCoupons(),
            'count' => LaraCart::count($withItemQty = false),
            'sub_total' => LaraCart::subTotal($formatted = false, $withDiscount = false) / 100,
            'fee_sub_total' => LaraCart::feeSubTotal($formatted = false, $withDiscount = false) / 100,
            'total_discount' => LaraCart::discountTotal($formatted = false) / 100,
            'total' => LaraCart::total($formatted = false, true) / 100,
        ]);
    }

    public function show(Request $request)
    {
        $cartItems = LaraCart::getItems();
        $response = [
            'items' => [],

            'fees' => LaraCart::getFees(),
            'coupons' => LaraCart::getCoupons(),
            'count' => LaraCart::count($withItemQty = false),
            'sub_total' => LaraCart::subTotal($formatted = false, $withDiscount = true) / 100,
            'fee_sub_total' => LaraCart::feeSubTotal($formatted = false, $withDiscount = true) / 100,
            'total_discount' => LaraCart::discountTotal($formatted = false) / 100,

            'total' => LaraCart::total($formatted = false, $withDiscount = false),
            'grand_total' => LaraCart::total($formatted = false, $withDiscount = true),
        ];

        foreach ($cartItems as $hash => $cartItem) {
            $response['items'][] = [
                'hash' => $hash,
                'name' => $cartItem->options['name'],
                'quantity' => $cartItem->options['qty'],
                'price' => $cartItem->options['price'],
                'color' => [
                    'id' => $cartItem->options['variant']->color->id,
                    'hex' => $cartItem->options['variant']->color->hex,
                    'name' => $cartItem->options['variant']->color->name,
                ],
                'img' => Vite::image($cartItem->options['model']->main_image),
                'size' => [
                    'id' => $cartItem->options['variant']->size->id,
                    'name' => $cartItem->options['variant']->size->name,
                ],
                //                'obj' => $cartItem,
                'product' => $cartItem->options['model'],
                //                'variants' => $cartItem->options['variant'],
                //                'variant' => $cartItem->options['variant'],
            ];

        }

        return $response;
    }

    public function store(Request $request)
    {

        $productVariant = ProductVariant::findOrFail($request->variant_id);
        $product = $productVariant->product;

        LaraCart::add(
            itemID: $product,
            price: (int) $productVariant->price_final,
            qty: $request->quantity,
            options: [
                'variant' => $productVariant,
                'color' => $productVariant->color,
                'size' => $productVariant->size,
                'price' => (int) $productVariant->price_final,
                'price_online' => (int) $productVariant->price_online,
                'price_final' => (int) $productVariant->price_final,
            ]
        );

        return response([
            'alert' => [
                'title' => $product->name,
                'type' => 'cart',
                'message' => __('alerts.addedToCart'),
                'button' => [
                    'label' => __('header.mobile-menu.cart'),
                    'href' => route('cart.index'),
                ],
            ],
        ], status: 200);

    }

    public function update(Request $request, $itemHash)
    {

        $variant = ProductVariant::findOrFail($request->input('variant_id'));

        LaraCart::updateItem($itemHash, 'itemID', $variant->product);

        LaraCart::updateItem($itemHash, 'qty', $request->quantity);
        LaraCart::updateItem($itemHash, 'price', $variant->price_final);
        LaraCart::updateItem($itemHash, 'options.price', $variant->price_final);
        LaraCart::updateItem($itemHash, 'price_online', $variant->price_online);
        LaraCart::updateItem($itemHash, 'price_final', $variant->price_final);
        LaraCart::updateItem($itemHash, 'variant', $variant);
        LaraCart::updateItem($itemHash, 'color', $variant->color);
        LaraCart::updateItem($itemHash, 'size', $variant->size);

        return response([
            'alert' => [
                'title' => __('alerts.cart.title'), // TODO - Translation
                'type' => 'success', // 'favorite' | 'cart' | 'success' | 'info' | 'error (cross "x")',
                'message' => __('alerts.cart.updated'), // TODO - Translation
                //                'button' => [
                //                    'label' => __('menu.cart'),
                //                    'href' => route('cart'),
                //                ],
                'options' => [
                    'timer' => 7000,
                ],
            ],
        ], status: 200);

    }

    public function destroy($itemHash)
    {
        LaraCart::removeItem($itemHash);

        return response([
            'alert' => [
                'title' => 'Cart', // TODO - Translation
                'type' => 'info', // 'favorite' | 'cart' | 'success' | 'info' | 'error (cross "x")',
                'message' => __('alerts.cart.removed'), // TODO - Translation
                //                'button' => [
                //                    'label' => __('menu.cart'),
                //                    'href' => route('cart'),
                //                ],
                'options' => [
                    'timer' => 1000,
                ],
            ],
        ], status: 200);
    }
}
