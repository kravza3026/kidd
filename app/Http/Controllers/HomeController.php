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

        //TODO Home Page Display

        $categories = Category::whereNull('parent_id')->get();

        $categories = $categories->first()->subcategories()->paginate(4);
        $products = $categories->first()->products()->limit(8)->get();

        return view('store.pages.home.index', compact('categories', 'products'));
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function search(Request $request)
    {
        if($request->has('term') && Str::length($request->term)) {
            $results['products'] = Product::search($request->term)->get();
            $results['categories'] = Category::search($request->term)->get();
            return view('shared.search.result', compact('results'))->render();
        }

        return view('shared.search.index');
    }

}
