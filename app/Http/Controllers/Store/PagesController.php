<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function locations()
    {
        return view('store.static.locations');
    }

    public function careers()
    {
        return view('store.static.careers');
    }

    public function terms_conditions()
    {
        return view('store.static.terms_conditions');
    }

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
}
