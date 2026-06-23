<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Order;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Enums\Unit;

use function Spatie\LaravelPdf\Support\pdf;

class OrderInvoiceController extends Controller
{
    /**
     * Stream a downloadable PDF invoice for an order, reusing the storefront invoice template.
     */
    public function __invoke(Order $order)
    {
        $this->authorize('view', $order);

        $company = Company::first();
        $date = ($order->placed_at ?? $order->created_at)?->format('Y-m-d') ?? 'draft';

        return pdf()
            ->view('store.account.orders.invoice', compact('order', 'company'))
            ->format(Format::A4)
            ->margins(80, 24, 120, 24, Unit::Pixel)
            ->headerView('store.account.orders._invoice-header', compact('order'))
            ->footerView('store.account.orders._invoice-footer', compact('order'))
            ->withBrowsershot(function ($browsershot) {
                $browsershot->scale(0.85);
                $browsershot->windowSize(1920, 1080);
                $browsershot->setOption('args', ['--disable-web-security', '--allow-file-access-from-files']);
                $browsershot->setOption('printBackground', true);
                $browsershot->waitUntilNetworkIdle();
            })
            ->name('invoice_'.$order->order_number.'_'.$date.'.pdf')
            ->download();
    }
}
