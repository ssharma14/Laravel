<?php

namespace App\Http\Controllers;

use App\Models\Work;

class HomeController extends Controller
{
    public function index()
    {
        $formToken = encrypt(['timestamp' => now()->timestamp]);

        return view('home')->with([
            'works' => Work::orderBy('sort_order')->get(),
            'formToken' => $formToken,
        ]);
    }
}
