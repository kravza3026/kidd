<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $favorites = json_decode($request->cookie('favorites', '[]'));
        $user_favorites = $request->user()->favorites->pluck('id')->toArray();
        $merged_favorites = array_unique(array_merge( $user_favorites, $favorites));
        $request->user()->favorites()->sync($merged_favorites);
        $cookie = cookie('favorites', json_encode($merged_favorites, null,1), 60 * 24 * 30, null, null, true, false);

        return redirect()->intended()->withCookie($cookie);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
