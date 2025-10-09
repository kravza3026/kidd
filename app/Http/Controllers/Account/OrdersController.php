<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
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
        ]);
    }

    public function invoice(Order $order)
    {
        //        $pdf = Pdf::loadView('store.account.orders.invoice', compact('order'));
        //
        //        return $pdf->stream('invoice.pdf');

        //        return Browsershot::html(\view('store.account.orders.invoice', compact('order'))->render())
        //            ->headerHtml(view('store.account.orders._invoice-header', compact('order'))->render())
        //            ->footerHtml(view('store.account.orders._invoice-footer', compact('order'))->render())
        //            ->hideBrowserHeaderAndFooter()
        //            ->windowSize(1920, 1080)
        //            ->setOption('args', ['--disable-web-security'])
        //            ->setOption('printBackground', true)
        //            ->waitUntilNetworkIdle()
        //            ->pdf();

        return Pdf::view('store.account.orders.invoice', compact('order'))
            ->format(Format::A4)
            ->margins(80, 24, 100, 24, Unit::Pixel)
            ->headerView('store.account.orders._invoice-header', compact('order'))
            ->footerView('store.account.orders._invoice-footer', compact('order'))
            ->withBrowsershot(function ($browsershot) {
                $browsershot->scale(0.85);
                $browsershot->windowSize(1920, 1080);
                //                $browsershot->setOption('args', ['--disable-web-security']);
                //                $browsershot->setOption('args', ['--allow-file-access-from-files']);
                //                $browsershot->setOption('printBackground', true);
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
