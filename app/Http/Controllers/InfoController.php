<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class InfoController extends Controller
{
    public function about_us(): View
    {
        return view('pages.info.about-us');
    }
}
