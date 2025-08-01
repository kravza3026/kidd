<?php

namespace App\Http\Controllers\Store;

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

        $cart = LaraCart::setInstance('default');
        $cart = $cart->cart;
//                LaraCart::emptyCart();
        //        LaraCart::destroyCart();

//        $product = Product::findOrFail(123);
//        $variants = $product->variants;
//
//                $item = LaraCart::add(
//                    $variants->last(),
//                    rand(1, 10),
//                );
//
////         Adding an item to the cart
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

        $coupons[] = new Fixed('test_fixed', 1000 * 100, [
            'description' => '1,000 MDL reducere',
            'taxable' => false,
        ]);

        $coupons[] = new Percentage('test_percent', '0.5', [
            'description' => '50% Discount',
            'taxable' => false,
        ]);

//            $coupons[] = new FreeDeliveryCoupon('free_delivery', 500, [
//                'description' => 'Livrare gratuită',
//                'taxable' => false,
//            ]);

        foreach ($coupons as $coupon) {
            LaraCart::addCoupon($coupon);
        }
        //        LaraCart::removeCoupon('free_delivery');

        LaraCart::addFee('delivery', 50 * 100, $taxable = false, $options = ['description' => 'Delivery fee']);
        LaraCart::addFee('free_delivery', -50 * 100, $taxable = false, $options = ['description' => 'Free delivery']);

        LaraCart::addFee('gift', 300 * 100, $taxable = false, $options = ['description' => 'Gift wrap']);
        LaraCart::addFee('express_delivery', 150 * 100, $taxable = false, $options = ['description' => 'Express delivery']);
        //        LaraCart::addFee('free_express_delivery', -150 * 100, $taxable = false, $options = ['description' => 'Free Express delivery promo']);

        //        LaraCart::removeFee('inflation');
        //        LaraCart::removeFee('gift');
        //        LaraCart::removeFee('express_delivery');
        //        LaraCart::removeFee('free_express_delivery');

//        dump($cart);

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
            'sub_total' => LaraCart::subTotal($formatted = false, $withDiscount = true) / 100,
            'fee_sub_total' => LaraCart::feeSubTotal($formatted = false, $withDiscount = true) / 100,
            'total_discount' => LaraCart::discountTotal($formatted = false) / 100,
            'total' => LaraCart::total($formatted = false, $withDiscount = true) / 100,
        ]);
    }

    public function show(Request $request)
    {
        $cartItems = LaraCart::getItems();
        $response = [
            'items' => [],
            'grand_total' => LaraCart::total($formatted = true, $withDiscount = true)
        ];
        foreach ($cartItems as $hash => $cartItem) {
            $response['items'][] = [
                'id' => $hash,
                'name' => $cartItem->options['model']->product->name,
                'quantity' => $cartItem->options['qty'],
                'price' => $cartItem->options['price'],
                'color' => $cartItem->options['model']->color->name,
                'color_id' => $cartItem->options['model']->color->id,
                'hex' => $cartItem->options['model']->color->hex,
                'colorName' => $cartItem->options['model']->color->name,
                'img' => Vite::image($cartItem->options['model']->product->main_image),
                'size' => $cartItem->options['model']->size->name,
                'size_id' => $cartItem->options['model']->size->id,
//                'obj' => $cartItem,
//                'variant' => $cartItem->options['model'],
                'product' => $cartItem->options['model']->product,
            ];

        }


        return $response;
    }

    public function store(Request $request)
    {

        $productVariant = ProductVariant::findOrFail($request->variant_id);

        LaraCart::add(
            $productVariant,
            $request->quantity,
        );

//        showAlert({
//            title: response.data.product.name,
//            type: 'cart',
//            message: t('alerts.addedToCart'),
//            icon: 'cart',
//            button: {
//        label: t('menu.cart'),
//                href: `/${locale.value}/cart`,
//            }
//        });

//        return response([
//            'alert' => [
//                'title' => $productVariant->product->name,
//                'type' => "cart",
//                'message' => __('alerts.addedToCart'),
//                'icon' => 'cart', // наприклад: 'favorites' | 'cart' | 'success (checkmark)' | 'info (i letter)' | 'error (cross "x")',
//                'button' => [
//                    'label' => __('menu.cart'),
//                    'href' => route('cart'),
//                ],// { label: "View Cart", href: "/en/cart" }
//            ],
//        ], status: 200);

        return response(status: 204);

    }

    public function update(Request $request, $itemHash)
    {

//        LaraCart::find($itemHash)->update($request->all());

        return response(content: null, status: 201);

    }

    public function destroy($itemHash)
    {
        LaraCart::removeItem($itemHash);

//      return response(content: null, status: 204);

//        return back();
        return response()->json([
            'message' => 'Item removed'
        ], 200);
    }
}
