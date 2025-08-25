<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;

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
        return view('store.account.orders.invoice', [
            'order' => $order,
        ]);
    }

    public function download(Order $order)
    {
        return 'Invoice download';
    }
}
