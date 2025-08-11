<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gender;

class GenderController extends Controller
{
    public function index()
    {
        $genders = Gender::select('id', 'name','svg','bg_color')->get();
        return response()->json($genders);
    }
}
