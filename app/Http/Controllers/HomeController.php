<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(): View
    {

        //TODO Home Page New Arrivals Query
        $products = Product::latest()->take(16)->get();

        return view('store.pages.home.index', compact( 'products'));
    }

    public function search(Request $request)
    {

        // TODO Move this endpoint to API Route & Controllers
        // TODO Add Search Validation & Limitations
        if($request->has('term') && (Str::length($request->term) > 3)) {
            $results = Product::search($request->input('term'))->get();
            return response()->json(compact('results'));
        }

        return response()->json([
            'results' => [],
            'message' => __('search.no_results'),
        ]);
    }

}
