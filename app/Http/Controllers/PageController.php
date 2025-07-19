<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about()
    {
        return view('store.static.about');
    }

    public function help()
    {
        return view('store.static.help');
    }

    public function contacts()
    {
        return view('store.static.contacts');
    }

    public function locations()
    {
        return view('store.static.locations');
    }
    public function careers()
    {
        return view('store.static.careers');
    }
    public function terms()
    {
        return view('store.static.terms');
    }
}
