<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function addresses(Request $request)
    {

        $user = $request->user();
        $user->load('addresses');

        $response = [
            'addresses' => $user->addresses,
        ];

        return response($response, 200);

    }

    public function storeAddress(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'region_id' => 'required',
            'city_id' => 'required',
            'street_name' => 'required|string',
            'building' => 'required|string',
            'apartment' => 'nullable|string',
            'entrance' => 'nullable|string',
            'floor' => 'nullable|string',
            'address_type' => 'required',
        ]);

//        $address = $user->addresses()->create($data);

        return response()->json([
            'message' => 'Address created successfully',
            'address' => $data,
        ], 201);
    }

}
