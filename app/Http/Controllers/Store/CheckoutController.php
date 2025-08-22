<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use LukePOLO\LaraCart\Facades\LaraCart;

class CheckoutController extends Controller
{
    protected array $steps = [
        'shipping' => [
            'view' => 'store.checkout.shipping',
            'rules' => [
                'shipping_address' => 'required|string',
                'shipping_city' => 'required|string',
                'shipping_region' => 'required|string',
                'shipping_postcode' => 'required|string',
                'shipping_building' => 'required|string',
                'saved_address'=>'string'
            ],
        ],
        'contact' => [
            'view' => 'store.checkout.contact',
            'rules' => [
                'contact_first_name' => 'required|string',
                'contact_last_name' => 'required|string',
                'contact_email' => 'required|string',
                'contact_phone' => 'required|string',
            ],
        ],
        'payment' => [
            'view' => 'store.checkout.payment',
            'rules' => [
                'payment_method' => 'required|string',
                'card_number' => 'required_if:payment_method,card',
                'card_expiry' => 'required_if:payment_method,card',
                'card_cvv' => 'required_if:payment_method,card',
            ],
        ],
        'review' => [
            'view' => 'store.checkout.review',
            'rules' => [],
        ],
    ];

    public function index(): View
    {

        $currentStep = Session::get('checkout_step', 'shipping');
        $checkoutData = Session::get('checkout_data', []);

        $regions = Cache::flexible('regions', [60, 1800],function () {
            // TODO - Normalize caching timings across the app, maybe use a repository pattern.
            return Region::with('cities')
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();
        });

        return view($this->steps[$currentStep]['view'], [
            'checkoutData' => $checkoutData,
            'currentStep' => $currentStep,
            'regions' => $regions,
            'items' => LaraCart::getItems(),
            'fees' => LaraCart::getFees(),
            'coupons' => LaraCart::getCoupons(),
            'count' => LaraCart::count($withItemQty = false),
            'sub_total' => LaraCart::subTotal($formatted = false, $withDiscount = true) / 100,
            'fee_sub_total' => LaraCart::feeSubTotal($formatted = false, $withDiscount = true) / 100,
            'total_discount' => LaraCart::discountTotal($formatted = false) / 100,
            'total' => LaraCart::total($formatted = false, true) / 100,
        ]);

    }

    public function processStep(Request $request, string $step): RedirectResponse
    {
        if (!array_key_exists($step, $this->steps)) {
            abort(404);
        }

        $validator = Validator::make(
            $request->all(),
            $this->steps[$step]['rules']
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $checkoutData = Session::get('checkout_data', []);
        $checkoutData = array_merge($checkoutData, $validator->validated());
        Session::put('checkout_data', $checkoutData);

        $nextStep = $this->getNextStep($step);
        Session::put('checkout_step', $nextStep);

        if ($nextStep === 'review') {
            return redirect()->route('checkout.review');
        }

        return redirect()->route('checkout.index');
    }

    protected function getNextStep(string $currentStep): string
    {
        $steps = array_keys($this->steps);
        $currentIndex = array_search($currentStep, $steps);

        return $steps[min($currentIndex + 1, count($steps) - 1)];
    }

    // Add new method to handle back navigation
    public function previous(string $step): RedirectResponse
    {
        $previousStep = $this->getPreviousStep($step);
        Session::put('checkout_step', $previousStep);

        return redirect()->route('checkout.index');
    }

    protected function getPreviousStep(string $currentStep): string
    {
        $steps = array_keys($this->steps);
        $currentIndex = array_search($currentStep, $steps);

        return $steps[max(0, $currentIndex - 1)];
    }


    public function review(): View|RedirectResponse
    {
        if (Session::get('checkout_step') !== 'review') {
            return redirect()->route('checkout.index');
        }

        return view('store.checkout.review', [
            'checkoutData' => Session::get('checkout_data', []),
            'currentStep' => 'review', // Add this line
            'items' => LaraCart::getItems(),
            'fees' => LaraCart::getFees(),
            'coupons' => LaraCart::getCoupons(),
            'count' => LaraCart::count($withItemQty = false),
            'sub_total' => LaraCart::subTotal($formatted = false, $withDiscount = true) / 100,
            'fee_sub_total' => LaraCart::feeSubTotal($formatted = false, $withDiscount = true) / 100,
            'total_discount' => LaraCart::discountTotal($formatted = false) / 100,
            'total' => LaraCart::total($formatted = false, true) / 100,
        ]);
    }

    public function complete(Request $request): RedirectResponse
    {
        if (Session::get('checkout_step') !== 'review') {
            return redirect()->route('checkout.index');
        }

        // TODO: Implement order processing

        Session::forget(['checkout_step', 'checkout_data']);

        Session::flash('toast', [
            'title' => __('Order Placed'),
            'type' => 'success',
            'message' => __('Your order has been successfully placed.'),
        ]);

        if (auth()->check()) {
            return redirect()->route('orders.index');
        }

        return redirect()->route('home');
    }
}
