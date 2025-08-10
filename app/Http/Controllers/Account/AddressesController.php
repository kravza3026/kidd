<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;

class AddressesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): mixed
    {

        $user = $request->user();
        $user->load('addresses');

        $countries = Country::all();

        if($request->wantsJson()){
            return $user->addresses->toJson();
        }

        return view('store.account.addresses.index',
            compact('user', 'countries')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        dd($request->all());
        $validated = $request->validate([
            'address_type' => 'required|string',
            'region_id' => 'required|integer',
            'city_id' => 'required|integer',
            'street_name' => 'required|string',
            'building' => 'required|string',
            'apartment' => 'nullable|string',
            'entrance' => 'nullable|string',
            'floor' => 'nullable|string',
            'intercom' => 'nullable|string',
            'postal_code' => 'nullable|string',
        ]);

        $user = $request->user();

        $address = $user->addresses()->create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Address created successfully',
                'address' => $address
            ], 201);
        }

        return redirect()
            ->route('account.addresses.index')
            ->with('success', 'Address created successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        return $address->address_type;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
}
