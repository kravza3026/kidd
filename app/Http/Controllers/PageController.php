<?php

namespace App\Http\Controllers;

class PageController extends Controller
{

    /**
     * Display the specified static page.
     *
     * @return \Illuminate\View\View
     */
    public function locations()
    {
        return view('store.static.locations');
    }

    /**
     * Display the careers page.
     */
    public function careers()
    {
        return view('store.static.careers');
    }

    /**
     * Display the terms and conditions page.
     */
    public function terms()
    {
        return view('store.static.terms');
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        return view('store.static.about');
    }

    /**
     * Display the help page.
     */
    public function help()
    {
        return view('store.static.help');
    }

    /**
     * Display the contacts page.
     */
    public function contacts()
    {
        return view('store.static.contacts');
    }

}
