<?php

namespace App\Http\Controllers;

use App\Models\Founder;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        return view('about', [
            'founders' => Founder::orderBy('sort_order')->get(),
        ]);
    }
}
