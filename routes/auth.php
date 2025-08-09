<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\PhoneVerificationNotificationController;
use App\Http\Controllers\Auth\PhoneVerificationPromptController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\VerifyPhoneController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Account\AddressesController;
use App\Http\Controllers\Account\FamilyController;
use App\Http\Controllers\Account\FavoritesController;
use App\Http\Controllers\Account\OrdersController;
use App\Http\Controllers\Account\ProfileController;


Route::group([
    'middleware' => ['auth'],
    'prefix' => 'account',
], function () {

    Route::get('profile', [ProfileController::class, 'index'])
        ->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::resource('family', FamilyController::class)
        ->only(['edit', 'store', 'update', 'destroy','show']);

    Route::resource('favorites', FavoritesController::class)
        ->only(['index', 'store', 'destroy']);

    Route::resource('orders', OrdersController::class)
        ->only(['index', 'show']);

    Route::resource('addresses', AddressesController::class)
        ->only(['index', 'store', 'update', 'destroy']);

});

Route::middleware('guest')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

});

Route::middleware('auth')->group(function () {

    // Email verification
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Phone verification
    Route::get('verify-phone', PhoneVerificationPromptController::class)
        ->name('phone.verification.notice');
    Route::get('verify-phone/{id}/{code}', VerifyPhoneController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('phone.verification.verify');
    Route::post('phone/verification-notification', [PhoneVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('phone.verification.send');

    // Password confirmation
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
