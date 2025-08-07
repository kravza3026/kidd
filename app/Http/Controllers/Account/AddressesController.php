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

//        dd($user->addresses);

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
        //
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
