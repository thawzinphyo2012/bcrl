<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogueController extends Controller
{
    public function index(): View
    {
        return view('studio.catalogue', [
            'songs' => Song::with('group')->orderByDesc('released_on')->get(),
        ]);
    }

    public function update(Request $request, Song $song): RedirectResponse
    {
        $data = $request->validate([
            'released_on' => ['required', 'date'],
            'songwriter' => ['nullable', 'string', 'max:160'],
            'producer' => ['nullable', 'string', 'max:160'],
            'recording' => ['nullable', 'string', 'max:160'],
            'description' => ['required', 'string', 'max:1000'],
        ]);

        $song->update([
            'released_on' => $data['released_on'],
            'songwriter' => $data['songwriter'] ?: null,
            'producer' => $data['producer'] ?: null,
            'recording' => $data['recording'] ?: null,
            'description' => $data['description'],
        ]);

        return back()->with('status', "{$song->title} was updated.");
    }
}
