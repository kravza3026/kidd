<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request)
    {

        return view('store.account.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        return view('store.account.profile.edit', [
            'user' => $request->user(),
        ]);

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('phone')) {
            $request->user()->phone_verified_at = null;
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->user()->isDirty('password')) {
            $request->user()->password = Hash::make($request->validated()['password']);
        }

        $request->user()->save();

        return Redirect::route('profile.edit')
            ->with(['success' => true, 'message' => 'Profile updated successfully']);
    }
}
