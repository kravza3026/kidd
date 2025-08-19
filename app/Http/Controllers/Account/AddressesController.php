<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
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

}
