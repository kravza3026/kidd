<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/');
        }

        $request->user()->sendEmailVerificationNotification();

        Session::flash('toast', [
            'title' => 'Account', // TODO - Translate.
            'type' => 'success',
            'message' => 'A new verification code has been sent to your email.', // TODO - Translate.
//            'button' => [
//                'href' => '/',
//                'label' => 'Account'
//            ]
        ]);
        return back();
    }
}
