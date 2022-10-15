<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;

use App\Mail\ContactMail;

use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Write code on Method
     *
     *
     */
    public function create()
    {
        return view('contact');
    }

    /**
     * Write code on Method
     *
     *
     */
    public function store(ContactRequest $request): RedirectResponse {

        $validatedData = $request->validated();

        Mail::to("sshrishti14@gmail.com")->send(new ContactMail($validatedData));

        return back()
            ->with(['success' => 'Thank you for contact us. we will contact you shortly.']);
        }
}

