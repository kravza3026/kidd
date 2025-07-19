<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
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
        $products = $categories->first()->products()->limit(12)->get();

        return view('store.home', compact('categories', 'products'));
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function search(Request $request)
    {
        if($request->hasHeader('HX-Request')){
            $results = Category::search($request->term)->get();
            return view('shared.search.result', compact('results'))->render();
        }

        return view('shared.search.index');
    }

}
