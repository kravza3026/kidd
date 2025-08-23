<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(): View
    {

        $products = auth()->user()->favorites()->paginate(request()->get('per_page', 16))->withQueryString();

        return view('store.account.favorites.index', compact('products'));
    }
}
