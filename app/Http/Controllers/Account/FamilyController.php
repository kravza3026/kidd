<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Family\StoreFamilyRequest;
use App\Models\Family;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FamilyController extends Controller
{

    public function index(Request $request)
    {
        return view('store.account.profile.partials.family-list', [
            'members' => $request->user()->family
        ]);
    }

    public function store(StoreFamilyRequest $familyRequest)
    {

        $family = [
            'gender_id' => Gender::BOY,
//            'gender_id' => $familyRequest->gender_id,
//            'name' => $familyRequest->name,
            'name' => 'Baby Boy',
            'birth_date' => Carbon::now()->subMonths(rand(1, 9)),
            'height' => 55,
            'weight' => 3445,
            'notes' => 'Test note...',
        ];

        $member = $familyRequest->user()->family()->create($family);

        return view('store.account.profile.partials.family-row', compact('member'));
    }

    public function create()
    {
        return view('store.account.profile.partials.family-add');
    }

    public function edit(Family $family)
    {
        return view('store.account.profile.partials.family-edit', [
            'member' => $family
        ]);
    }

    public function show(Family $family)
    {
        return view('store.account.profile.partials.family-row', [
            'member' => $family
        ]);
    }

    public function update(Family $family)
    {
//        $family->update($this->validate(request(), [
//            'gender_id' => 'required|integer',
//            'name' => 'required|string',
//            'birth_date' => 'required|date',
//            'height' => 'required|integer',
//            'weight' => 'required|integer',
//            'notes' => 'string',
//        ]));

        return view('store.account.profile.partials.family-row', [
            'member' => $family
        ]);
    }

    public function destroy(Family $family)
    {
        if ($family->delete()) {
            return response(content: null, status: 200);
        }
    }
}
