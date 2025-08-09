<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(): View
    {
        //TODO - Home Page New Arrivals Query
        $products = Product::latest()->take(16)->get();

        return view('store.pages.home.index', [
            'products' => $products,
        ]);

    }

}
