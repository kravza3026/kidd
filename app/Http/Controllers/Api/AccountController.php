<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\AddressStoreRequest;
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

    public function storeAddress(AddressStoreRequest $request)
    {

        $address = $request->user()->addresses()
            ->create($request->validated());

        return response()->json(compact('address'), 201);
    }

}
