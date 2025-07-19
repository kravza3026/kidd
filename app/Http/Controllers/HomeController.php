<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('static.about');
    }

    public function help()
    {
        return view('static.help');
    }

    public function contacts()
    {
        return view('static.contacts');
    }
}
