<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class GeneralController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function favorites(Request $request): Response
    {

        if (auth()->check()) {
            // The favorites cookie is client-controlled — only sync ids that are real products.
            $decoded = json_decode($request->cookie('favorites', '[]'), true);

            $ids = collect(is_array($decoded) ? $decoded : [])
                ->filter(fn ($id): bool => is_numeric($id))
                ->map(fn ($id): int => (int) $id);

            $validIds = Product::whereKey($ids)->pluck('id')->all();

            $request->user()->favorites()->sync($validIds);
        }

        return response(null, 204);

    }

    public function search(Request $request): Response|JsonResponse
    {

        $results = [];

        // TODO - Add Search Validation & Limitations (20 results)
        if ($request->has('term') && (Str::length($request->term) > 2)) {
            $results = Product::search($request->input('term'))->take(20)->get();
        }

        return response()->json(compact('results'));
    }

    public function regions(Request $request)
    {
        return response()->json(['regions' => Region::orderBy('sort_order')->orderBy('id')->get(['name', 'id'])]);
    }

    public function cities(Request $request)
    {

        if ($request->hasHeader('HX-Request')) {
            return view('partials.htmx.dynamic-select', [
                'cities' => Region::findOrFail($request->get('shipping_region', 9))->cities()->get(['name', 'id']),
            ]);
        }

        return response()->json([
            'region' => $request->get('region_id'),
            'cities' => Region::findOrFail($request->get('region_id', 9))->cities()->get(['name', 'id']),
        ]);
    }
}
