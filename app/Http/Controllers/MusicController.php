<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use App\Models\Song;
use Illuminate\View\View;

class MusicController extends Controller
{
    public function index(): View
    {
        $songs = Song::with('group')->orderByDesc('released_on')->orderBy('sort_order')->get();

        return view('music.index', [
            'songs' => $songs,
            'latest' => $songs->take(4),
            'highlights' => $songs->where('is_highlight', true)->sortBy('highlight_position')->values(),
            'months' => $songs->groupBy(fn (Song $song) => $song->released_on->format('F Y')),
            'stories' => NewsPost::query()
                ->whereIn('category', ['Events & Collaborations', 'BCRL Milestones', 'Artist Activities'])
                ->orderByDesc('published_at')
                ->take(3)
                ->get(),
            'interviews' => NewsPost::query()
                ->whereNotNull('youtube_url')
                ->orderByDesc('published_at')
                ->get(),
        ]);
    }

    public function show(Song $song): View
    {
        $song->load('group');

        return view('music.show', [
            'song' => $song,
            'related' => Song::with('group')
                ->where('group_id', $song->group_id)
                ->whereKeyNot($song->id)
                ->orderByDesc('released_on')
                ->get(),
        ]);
    }
}
