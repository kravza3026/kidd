<?php

namespace App\Http\Controllers\Store\Pages;

use App\Http\Controllers\Controller;
use App\Models\Location;

class LocationsController extends Controller
{
    /**
     * Display a listing of the locations.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $locations = Location::with('address')->get();

        return view('store.pages.static.locations', [
            'locations' => $locations,
        ]);
    }
}
