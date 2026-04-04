<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
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
        // Generate timestamp token for time-based validation
        $formToken = encrypt(['timestamp' => now()->timestamp]);
        return view('contact', compact('formToken'));
    }

    /**
     * Write code on Method
     *
     *
     */
    public function store(ContactRequest $request) {
        $validatedData = $request->validated();

        Mail::to("sshrishti14@gmail.com")->send(new ContactMail($validatedData));

        // Handle AJAX requests
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your submission has been received!'
            ]);
        }

        // Handle regular form submissions (fallback)
        return back()
            ->with(['success' => 'Thank you! Your submission has been received!']);
    }
}

