<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RosterController extends Controller
{
    public function index(): View
    {
        return view('studio.roster', [
            'groups' => Group::with('members')->orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request, Member $member): RedirectResponse
    {
        $data = $request->validate([
            'bio' => ['nullable', 'string', 'max:800'],
        ]);

        $member->update([
            'bio' => $data['bio'] ?: null,
        ]);

        return back()->with('status', "{$member->name} was updated.");
    }
}
