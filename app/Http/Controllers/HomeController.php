<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\NewsPost;
use App\Models\Song;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'groups' => Group::withCount('members')->with('songs')->orderBy('sort_order')->get(),
            'highlights' => Song::with('group')->where('is_highlight', true)->orderBy('highlight_position')->get(),
            'posts' => NewsPost::orderByDesc('published_at')->take(3)->get(),
        ]);
    }
}
