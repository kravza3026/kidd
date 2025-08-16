<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PhoneVerificationRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

class VerifyPhoneController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(PhoneVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedPhone()) {
            return redirect()->intended('/?phone=1');
        }

        if ($request->user()->markPhoneAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended('/?phone=1');
    }
}
