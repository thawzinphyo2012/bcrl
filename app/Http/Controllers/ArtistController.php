<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\View\View;

class ArtistController extends Controller
{
    public function index(): View
    {
        return view('artists.index', [
            'groups' => Group::withCount('members')->with('songs')->orderBy('sort_order')->get(),
        ]);
    }

    public function show(Group $group): View
    {
        $group->load(['members', 'songs']);

        return view('artists.show', [
            'group' => $group,
        ]);
    }
}
