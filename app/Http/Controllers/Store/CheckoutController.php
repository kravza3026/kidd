<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Checkout\ContactStoreRequest;
use App\Http\Requests\Checkout\PaymentStoreRequest;
use App\Http\Requests\Checkout\ShippingStoreRequest;
use App\Services\CheckoutSessionService;
use App\Services\CheckoutViewDataService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

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

    public function complete(Request $request): RedirectResponse
    {
        if (! $this->sessionService->canAccessReview()) {
            return redirect()->route('checkout.index');
        }

        // TODO: Implement order processing logic
        // $orderService = app(OrderService::class);
        // $order = $orderService->createFromCheckoutData($this->sessionService->getCheckoutData());

        $this->sessionService->clearCheckoutSession();

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
