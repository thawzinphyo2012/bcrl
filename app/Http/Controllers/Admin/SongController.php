<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Song;
use App\Support\Slug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SongController extends Controller
{
    public function index(Request $request): View
    {
        $groupId = $request->integer('group');

        return view('admin.songs.index', [
            'groups' => Group::orderBy('sort_order')->get(),
            'groupId' => $groupId ?: null,
            'songs' => Song::with('group')
                ->when($groupId, fn ($query) => $query->where('group_id', $groupId))
                ->orderByDesc('released_on')
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.songs.form', [
            'song' => new Song([
                'released_on' => now()->toDateString(),
                'is_highlight' => false,
                'sort_order' => (Song::max('sort_order') ?? 0) + 1,
            ]),
            'groups' => Group::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        unset($data['slug']);
        $data['slug'] = Slug::unique($request->filled('slug') ? $request->string('slug')->toString() : $data['title'], 'songs');
        $data['is_highlight'] = $request->boolean('is_highlight');

        Song::create($data);

        return redirect()->route('admin.songs.index')->with('status', 'Song created.');
    }

    public function edit(Song $song): View
    {
        return view('admin.songs.form', [
            'song' => $song,
            'groups' => Group::orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request, Song $song): RedirectResponse
    {
        $data = $this->validated($request);
        unset($data['slug']);
        $data['is_highlight'] = $request->boolean('is_highlight');
        if ($request->filled('slug')) {
            $data['slug'] = Slug::unique($request->string('slug')->toString(), 'songs', $song->id);
        }

        $song->update($data);

        return redirect()->route('admin.songs.index')->with('status', 'Song updated.');
    }

    public function destroy(Song $song): RedirectResponse
    {
        $song->delete();

        return redirect()->route('admin.songs.index')->with('status', 'Song deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'group_id' => ['required', 'exists:groups,id'],
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180'],
            'listen_url' => ['required', 'url', 'max:500'],
            'description' => ['required', 'string', 'max:1000'],
            'songwriter' => ['nullable', 'string', 'max:160'],
            'producer' => ['nullable', 'string', 'max:160'],
            'recording' => ['nullable', 'string', 'max:160'],
            'released_on' => ['required', 'date'],
            'highlight_position' => ['nullable', 'integer', 'min:1', 'max:99'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:255'],
        ]);
    }
}
