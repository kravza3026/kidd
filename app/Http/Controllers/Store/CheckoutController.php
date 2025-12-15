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
use Illuminate\Support\Facades\Vite;
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
        //        $orderService = app(OrderService::class);
        //        $order = $orderService->createFromCheckoutData($this->sessionService->getCheckoutData());
        $checkout = $this->sessionService->getCheckoutData();

        $cart = LaraCart::setInstance('default');
        $cart = $cart->cart;

        $customer = Customer::firstOrCreate([
            'email' => $checkout['contact_email'],
            'phone' => $checkout['contact_phone'],
        ], [
            'company_id' => 1, // TODO - implement tenant...
            'user_id' => auth()->id(),
            'first_name' => $checkout['contact_first_name'],
            'last_name' => $checkout['contact_last_name'],
        ]);

        DB::transaction(function () use ($checkout, $cart, $customer) {

            $order = Order::lockForUpdate()->create([
                'customer_id' => $customer->id,
                'tracking_id' => 1, // TODO - implement tracking id...
                'payment_id' => 1, // TODO - implement payment id...
                'total_amount' => LaraCart::total($formatted = false, $withDiscount = true), // Will be updated after items are added
                'status' => OrderStatus::Pending->value,
                'shipping_method' => ShippingMethod::from((int) $checkout['shipping_method']),
                'payment_method' => PaymentMethod::from((int) $checkout['payment_method']),
                'cart_snapshot' => collect($cart)->toArray(),
                'notes' => '',
            ]);

            $order->items()->createMany(
                collect($this->viewDataService->getCartData()['items'])->map(function ($item) {
                    return [
                        'product_variant_id' => $item->options['variant']->id,
                        'variant_snapshot' => $item->options['variant']->toArray(),
                        'quantity' => $item->qty,
                        'unit_price' => $item->options['price'],
                        'total_price' => ($item->price * $item->qty),
                    ];
                })->toArray()
            );

            $shippingAddress = [
                'label' => $customer->id.'.'.$checkout['shipping_postal_code'].'.'.AddressType::Shipping->value,
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

            $billingAddress = [
                'label' => $customer->id.'.'.$checkout['billing_postal_code'].'.'.AddressType::Billing->value,
                'region_id' => $checkout['billing_region'],
                'city_id' => $checkout['billing_city'],
                'street_name' => $checkout['billing_street_name'],
                'building' => $checkout['billing_building'],
                'postal_code' => $checkout['billing_postal_code'],
                'apartment' => $checkout['billing_apartment'],
            ];

            $order->addresses()->create([
                'address_type' => AddressType::Shipping,
                ...$shippingAddress,
            ]);

            $order->addresses()->create([
                'address_type' => AddressType::Billing,
                ...$billingAddress,
            ]);

        }, attempts: 3);

        $this->sessionService->clearCheckoutSession();
        LaraCart::emptyCart();

        // TODO - Use it globally.
        Session::flash('modal', [
            'title' => __('general.modal.title-order'),
            'message' => __('general.modal.message-order'),
            'image' => [
                'url' => Vite::image('icons/olive/order.png'),
                'alt' => __('general.modal.img_alt-order'),
            ],
        ]);

        return auth()->check()
            ? redirect()->route('orders.index')
            : redirect()->route('home');
    }
}
