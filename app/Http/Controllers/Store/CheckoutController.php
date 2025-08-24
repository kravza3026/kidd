<?php

namespace App\Http\Controllers\Store;

use App\Enums\AddressType;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\ShippingMethod;
use App\Http\Controllers\Controller;
use App\Http\Requests\Checkout\ContactStoreRequest;
use App\Http\Requests\Checkout\PaymentStoreRequest;
use App\Http\Requests\Checkout\ShippingStoreRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Services\CheckoutSessionService;
use App\Services\CheckoutViewDataService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use LukePOLO\LaraCart\Facades\LaraCart;
use Throwable;

class CheckoutController extends Controller
{
    public function __construct(
        private readonly CheckoutSessionService $sessionService,
        private readonly CheckoutViewDataService $viewDataService
    ) {}

    public function index(): View
    {
        $currentStep = $this->sessionService->getCurrentStep();
        $checkoutData = $this->sessionService->getCheckoutData();
        $viewName = $this->viewDataService->getStepView($currentStep);
        $viewData = $this->viewDataService->getStepViewData($currentStep, $checkoutData);

        return view($viewName, $viewData);
    }

    public function processShipping(ShippingStoreRequest $request): RedirectResponse
    {
        return $this->processValidatedStep($request->validated(), 'shipping');
    }

    private function processValidatedStep(array $validatedData, string $currentStep): RedirectResponse
    {
        $this->sessionService->storeStepData($validatedData);
        $nextStep = $this->sessionService->moveToNextStep($currentStep);

        if ($nextStep === 'review') {
            return redirect()->route('checkout.review');
        }

        return redirect()->route('checkout.index');
    }

    public function processContact(ContactStoreRequest $request): RedirectResponse
    {
        return $this->processValidatedStep($request->validated(), 'contact');
    }

    public function processPayment(PaymentStoreRequest $request): RedirectResponse
    {
        return $this->processValidatedStep($request->validated(), 'payment');
    }

    public function previous(string $step): RedirectResponse
    {
        if (! $this->sessionService->isValidStep($step)) {
            abort(404);
        }

        $this->sessionService->moveToPreviousStep($step);

        return redirect()->route('checkout.index');
    }

    public function review(): View|RedirectResponse
    {
        if (! $this->sessionService->canAccessReview()) {
            return redirect()->route('checkout.index');
        }

        $checkoutData = $this->sessionService->getCheckoutData();
        $viewData = $this->viewDataService->getReviewViewData($checkoutData);

        return view('store.checkout.review', $viewData);
    }

    /**
     * @throws Throwable
     */
    public function complete(Request $request): RedirectResponse
    {
        if (! $this->sessionService->canAccessReview()) {
            return redirect()->route('checkout.index');
        }

        // TODO: Implement order processing logic
        // $orderService = app(OrderService::class);
        // $order = $orderService->createFromCheckoutData($this->sessionService->getCheckoutData());
        $checkout = $this->sessionService->getCheckoutData();

        $cart = LaraCart::setInstance('default');
        $cart = $cart->cart;

        DB::transaction(function () use ($checkout, $cart) {

            $customer = Customer::firstOrCreate([
                'email' => $checkout['contact_email'],
                'phone' => $checkout['contact_phone'],
            ], [
                'company_id' => 1, // TODO - implement tenant...
                'user_id' => auth()->id(),
                'first_name' => $checkout['contact_first_name'],
                'last_name' => $checkout['contact_last_name'],
            ]);

            $shippingAddress = [
                'label' => $customer->id,
                'region_id' => $checkout['shipping_region'],
                'city_id' => $checkout['shipping_city'],
                'street_name' => $checkout['shipping_street_name'],
                'building' => $checkout['shipping_building'],
                'postal_code' => $checkout['shipping_postal_code'],
                'apartment' => $checkout['shipping_apartment'],
                'entrance' => $checkout['shipping_entrance'],
                'floor' => $checkout['shipping_floor'],
                'intercom' => $checkout['shipping_intercom'],
            ];

            $order = Order::create([
                'customer_id' => $customer->id,
                'tracking_id' => 1, // TODO - implement tracking id...
                'payment_id' => 1, // TODO - implement payment id...
                'order_number' => (Order::latest()->first()->id ?? 1) + 1, // TODO - implement order number...
                'total_amount' => LaraCart::total($formatted = false, $withDiscount = true), // Will be updated after items are added
                'status' => OrderStatus::Pending->value,
                'shipping_method' => ShippingMethod::from((int) $checkout['shipping_method']),
                'payment_method' => PaymentMethod::from((int) $checkout['payment_method'] + 1),
                'shipping_address' => $shippingAddress,
                'billing_address' => $shippingAddress,
                'cart_snapshot' => collect($cart)->toArray(),
                'notes' => '',
            ]);

            $order->items()->createMany(
                collect($this->viewDataService->getCartData()['items'])->map(function ($item) use ($order) {
                    return [
                        'order_id' => $order->id,
                        'product_variant_id' => $item->options['variant']->id,
                        'variant_snapshot' => $item->options['variant']->toArray(),
                        'quantity' => $item->qty,
                        'price' => $item->price * $item->qty,
                    ];
                })->toArray()
            );

            $order->update([
                'total_amount' => $order->items->sum('price'),
            ]);

            $address['shipping'] = $order->addresses()->create([
                'address_type' => AddressType::Shipping,
                ...$shippingAddress,
            ]);
            $address['billing'] = $address['shipping']->replicate()->fill([
                'address_type' => AddressType::Billing,
            ]);
            $address['billing']->save();

        });

        $this->sessionService->clearCheckoutSession();
        LaraCart::emptyCart();

        // TODO - Translate
        Session::flash('toast', [
            'title' => __('Order Placed'),
            'type' => 'success',
            'message' => __('Your order has been successfully placed.'),
        ]);

        return auth()->check()
            ? redirect()->route('orders.index')
            : redirect()->route('home');
    }
}
