<?php

namespace App\Http\Controllers\Store\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vacancy\VacancyApplicationStoreRequest;
use App\Models\Vacancy;
use App\Models\VacancyApplication;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Vite;

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

        if ($request->hasFile('cv')) {
            $applicationData['cv_file_path'] = $request->file('cv')
                ->store('vacancies/'.$request->vacancy_id.'/cv', 'local');
        }

        VacancyApplication::create($applicationData);

        // TODO - Use it globally.
        Session::flash('modal', [
            'title' => __('general.modal.title-vacancy'),
            'message' => __('general.modal.message-vacancy'),
            'image' => [
                'url' => Vite::image('icons/file.png'),
                'alt' => __('general.modal.img_alt-vacancy'),
            ],
        ]);

        return redirect()->route('vacancy.show', $vacancy);
    }
}
