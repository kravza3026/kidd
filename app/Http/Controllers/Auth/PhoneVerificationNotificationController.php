<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PhoneVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedPhone()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendPhoneVerificationNotification();

        return back()->with('status', 'verification-code-sent');
    }
}
