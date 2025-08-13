<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Family\MemberStoreRequest;
use App\Http\Requests\Family\MemberUpdateRequest;
use App\Models\Family;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Family::class);

        $family = auth()->user()->family;

        return response()->json([
            'family' => $family,
            'genders' => Gender::all(),
            'status' => 'success',
        ]);

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
    public function store(MemberStoreRequest $request)
    {
        $request->user()->family()
            ->create($request->validated());

        return response()->json(status:201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberUpdateRequest $request, Family $family)
    {
        if(auth()->user()->cannot('update', $family)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $family->update($request->validated());

        return response()->json(status:200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        if(auth()->user()->cannot('delete', $family)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $family->delete();

        return response()->json(status: 204);

    }
}
