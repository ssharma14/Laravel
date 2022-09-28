<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Home;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function index()
    {
        return view('home')->with([
            'works' => Work::all()
        ]);
    }
}
