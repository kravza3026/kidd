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
    public function storeAddress(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'region' => 'required|string',
            'city' => 'required|string',
            'street_name' => 'required|string',
            'building' => 'required|string',
            'apartment' => 'nullable|string',
            'entrance' => 'nullable|string',
            'floor' => 'nullable|string',
            'address_type' => 'required|string',
        ]);

        $address = $user->addresses()->create($data);

        return response()->json([
            'message' => 'Address created successfully',
            'address' => $address,
        ], 201);
    }

}
