<?php

namespace App\Http\Controllers\Store\Pages;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use App\Models\VacancyApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VacancyApplicationController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Vacancy $vacancy)
    {

        $vacancies = Vacancy::pluck('title', 'id');
        return view('store.pages.careers.application.create', compact('vacancy', 'vacancies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Vacancy $vacancy)
    {

        // TODO - Vacancy Application logic.


        // TODO - Make into success modal.
        Session::flash('toast', [
            'title' => 'Vacancy', // TODO - Translate.
            'type' => 'success',
            'message' => 'Application submitted successfully.', // TODO - Translate.
            'button' => [
                'href' => route('vacancy.index'),
                'label' => 'Vacancies', // TODO - Translate.
            ]
        ]);
        return redirect()->route('vacancy.show', $vacancy);
    }

    /**
     * Display the specified resource.
     */
    public function show(VacancyApplication $vacancyApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VacancyApplication $vacancyApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VacancyApplication $vacancyApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VacancyApplication $vacancyApplication)
    {
        //
    }
}
