<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function addresses(Request $request) {

    $user = $request->user();
    $user->load('addresses');
//    $user->load('addresses.region');

    $response = [
        'addresses' => $user->addresses,
//        'regions' => Region::get(['id', 'name']),
    ];

    return response($response, 200);

}
}
