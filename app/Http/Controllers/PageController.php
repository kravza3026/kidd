<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;

class PageController extends Controller
{

    /**
     * Display favorite products page for guests or redirect for users.
     *
     * @return View | RedirectResponse
     */
    public function favorites(Request $request): View | RedirectResponse {
        if(auth()->check()){
            return redirect()->route('favorites.index');
        }

        $products = Product::whereIn('id', json_decode($request->cookie('favorites', '[]')))->paginate(3)->withQueryString();

        return view('store.pages.favorites.index', [
            'products' => $products,
        ]);
    }

    /**
     * Display search results page.
     *
     * @return View
     */
    public function search(Request $request): View {
        $products = Product::whereIn('id', json_decode($request->cookie('favorites', '[]')))->paginate(3)->withQueryString();

        return view('store.pages.favorites.index', [
            'products' => $products,
        ]);
    }

    /**
     * Display the terms and conditions page.
     */
    public function terms() {
        return view('store.pages.static.terms');
    }

    /**
     * Display the about page.
     */
    public function about() {
        return view('store.pages.static.about');
    }

    /**
     * Display the help page.
     */
    public function help() {
        return view('store.pages.help.index');
    }

    /**
     * Display the contacts page.
     */
    public function contacts() {
        return view('store.pages.static.contacts');
    }

}
