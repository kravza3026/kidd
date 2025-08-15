<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\AddressStoreRequest;
use App\Http\Requests\Address\AddressUpdateRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function index(Request $request)
    {

        $user = $request->user();
        $user->load('addresses');

        $response = [
            'addresses' => $user->addresses,
        ];

        return response($response, 200);

    }

    public function store(AddressStoreRequest $request)
    {

        $address = $request->user()->addresses()
            ->create($request->validated());

        return response()->json(compact('address'), 201);
    }

    public function update(AddressUpdateRequest $request, Address $address)
    {
        // TODO - Check if the user owns the address

        $address->update($request->validated());

        return response()->json(compact('address'), 200);

    }

    public function destroy(Address $address)
    {

        // TODO - Check if the user owns the address

        $address->delete();

        return response()->json( status: 204);

    }

}
