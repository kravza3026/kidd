<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GeneralController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function favorites (Request $request): \Illuminate\Http\Response
    {

        if(auth()->check()) {
            $favorites = json_decode($request->cookie('favorites', '[]'));
            $request->user()->favorites()->sync($favorites);
        }

        return response(null, 204);

    }

    public function search(Request $request): \Illuminate\Http\Response | \Illuminate\Http\JsonResponse
    {

        $results = [];

        // TODO - Add Search Validation & Limitations (20 results)
        if($request->has('term') && (Str::length($request->term) > 2)) {
            $results = Product::search($request->input('term'))->take(20)->get();
        }

        return response()->json(compact('results'));
    }

    public function regions(Request $request)
    {
        return response()->json(['regions' => Region::orderBy('sort_order')->orderBy('id')->get(['name', 'id'])] );
    }

    public function cities(Request $request)
    {
        return response()->json([
            'region' => $request->get('region_id'),
            'cities' => Region::findOrFail($request->get('region_id', 9))->cities()->get(['name', 'id']),
        ]);
    }

}
