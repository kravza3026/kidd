<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {

        $products = auth()->user()->favorites()->paginate(request()->get('per_page', 16) )->withQueryString();

        return view('store.account.favorites.index', compact('products'));
    }

}
