<?php

namespace App\Http\Controllers\Account;

use App\Enums\ReturnReason;
use App\Enums\ReturnStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\OrderReturnRequest;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderReturn;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Enums\Unit;
use Spatie\LaravelPdf\Facades\Pdf;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('store.account.orders.index', [
            'user' => auth()->user(),
        ]);
    }

    public function track(Order $order)
    {
        return view('store.account.orders.track', [
            'order' => $order,
        ]);
    }

    public function return(Order $order)
    {
        return view('store.account.orders.return', [
            'order' => $order,
            'reasons' => ReturnReason::forSelect(),
        ]);
    }

    /**
     * Persist a customer return request for a delivered order and attach any uploaded photos.
     */
    public function storeReturn(OrderReturnRequest $request, Order $order): RedirectResponse
    {
        $return = new OrderReturn([
            'reason' => $request->integer('reason'),
            'status' => ReturnStatus::Pending,
            'item_ids' => $request->collect('items')->map(fn ($id): int => (int) $id)->all(),
            'comment' => $request->input('comment'),
        ]);
        $return->order()->associate($order);
        $return->customer()->associate($order->customer);
        $return->save();

        foreach ($request->file('images', []) as $image) {
            $return->addMedia($image->getRealPath())
                ->usingFileName($image->getClientOriginalName())
                ->toMediaCollection('images');
        }

        return redirect()
            ->route('orders.track', $order)
            ->with('toast', [
                'title' => __('order.return.submitted_title'),
                'type' => 'success',
                'message' => __('order.return.submitted'),
            ]);
    }

    public function invoice(Order $order)
    {
        $company = Company::first();

        return Pdf::view('store.account.orders.invoice', compact('order', 'company'))
            ->format(Format::A4)
            ->margins(80, 24, 120, 24, Unit::Pixel)
            ->headerView('store.account.orders._invoice-header', compact('order'))
            ->footerView('store.account.orders._invoice-footer', compact('order'))
            ->withBrowsershot(function ($browsershot) {
                $browsershot->scale(0.85);
                $browsershot->windowSize(1920, 1080);
                $browsershot->setOption(
                    'args', [
                        '--disable-web-security',
                        '--allow-file-access-from-files',
                    ],
                );
                //                $browsershot->setOption('args', ['--disable-web-security']);
                //                $browsershot->setOption('args', ['--allow-file-access-from-files']);
                $browsershot->setOption('printBackground', true);
                //                $browsershot->hideBrowserHeaderAndFooter();
                //                $browsershot->noSandbox();
                $browsershot->waitUntilNetworkIdle();
            })
            ->name($order->order_number.'_'.$order->placed_at->format('Y-m-d').'.pdf');
        //            ->download();

        //        return view('store.account.orders.invoice', [
        //            'order' => $order,
        //        ]);
    }

    public function download(Order $order)
    {
        return 'Invoice download';
    }
}
