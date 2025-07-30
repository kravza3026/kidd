<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the locations.
     */
    public function __invoke()
    {
        $locations = Location::with('address')->get();

        return view('store.static.locations',
        compact('locations')
        );
    }

}
