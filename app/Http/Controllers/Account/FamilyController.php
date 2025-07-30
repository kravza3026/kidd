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

    public function store(StoreFamilyRequest $request)
    {

        $family = [
            'gender_id' => Gender::BOY,
//            'gender_id' => $request->gender_id,
//            'name' => $request->name,
            'name' => 'Baby Boy',
            'birth_date' => Carbon::now()->year(rand(0, 2))->subMonths(rand(1, 9)),
            'height' => 55, // in centimeters
            'weight' => 3445, // in grams
            'notes' => 'Test note...',
        ];

        $member = $request->user()->family()->create($family);

        // TODO - Success message. w/ Global toast message.
        return response(content: $member, status: 201);
//        return view('store.account.profile.partials.family-row', compact('member'));
    }

    public function create()
    {
        return view('store.account.profile.partials.family-add')
            ->render();
    }

    public function edit(Family $family)
    {
        return view('store.account.profile.partials.family-edit', [
            'member' => $family
        ])->render();
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
        auth()->user()->can('destroy', $family);
        $family->delete();

        // TODO - Success message. w/ Global toast message.
        return response(content: null, status: 204);
    }
}
