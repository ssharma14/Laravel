<?php

namespace App\Http\Controllers;

use App\Models\Work;

class HomeController extends Controller
{
    public function index()
    {
        // Generate timestamp token for contact form spam protection
        $formToken = encrypt(['timestamp' => now()->timestamp]);

        return view('home')->with([
            'works' => Work::orderBy('sort_order')->get(),
            'formToken' => $formToken,
        ]);
    }
}
