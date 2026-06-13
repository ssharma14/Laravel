<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        $formToken = encrypt(['timestamp' => now()->timestamp]);

        return view('contact', compact('formToken'));
    }

    public function store(ContactRequest $request)
    {
        Mail::to('sshrishti14@gmail.com')->send(new ContactMail($request->validated()));

        $message = 'Thank you! Your submission has been received!';

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return back()->with('success', $message);
    }
}
