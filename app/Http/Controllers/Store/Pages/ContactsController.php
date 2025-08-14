<?php

namespace App\Http\Controllers\Store\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\ContactStoreRequest;
use App\Models\ContactInquire;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Vite;

class ContactsController extends Controller
{

    /**
    * Display page with contact form.
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View|object
    **/
    public function index()
    {
        return view('store.pages.static.contacts');
    }

    /**
     * Store contact form in database.
     * @param ContactStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactStoreRequest $request)
    {

        // Store contact inquiry in database
        ContactInquire::create($request->validated());

        Session::flash('modal', [
            'title' => __('general.modal.title-contacts'),
            'message' => __('general.modal.message-contacts'),
            'image' => [
                'url' => Vite::image('icons/chat.svg'),
                'alt' => __('general.modal.img_alt-contact'),
            ],
        ]);

        return redirect()->route('contacts');
    }

}
