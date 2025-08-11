<?php

namespace App\Http\Controllers\Store\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\VacancyApplicationStoreRequest;
use App\Models\Vacancy;
use App\Models\VacancyApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VacanciesApplicationController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Vacancy $vacancy)
    {

        $vacancies = Vacancy::pluck('title', 'id');

        return view('store.pages.careers.application.create', [
            'vacancies' => $vacancies,
            'vacancy' => $vacancy,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VacancyApplicationStoreRequest $request, Vacancy $vacancy)
    {
        $applicationData = $request->validatedExcept(['cv', 'terms']);

        if($request->hasFile('cv')) {
            $applicationData['cv_file_path'] = $request->file('cv')
                ->store('vacancies/'.$request->vacancy_id.'/cv', 'local');
        }

        VacancyApplication::create($applicationData);

        // TODO - Make into success modal.
        Session::flash('toast', [
            'title' => 'Vacancy', // TODO - Translate.
            'type' => 'success',
            'message' => 'Application submitted successfully.', // TODO - Translate.
            'options' => [
                'timer' => 10000,
            ],
//            'button' => [
//                'href' => route('vacancy.index'),
//                'label' => 'Vacancies', // TODO - Translate.
//            ]
        ]);
        return redirect()->route('vacancy.show', $vacancy);
    }

}
