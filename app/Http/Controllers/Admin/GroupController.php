<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Support\Slug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GroupController extends Controller
{
    public function index(): View
    {
        return view('admin.groups.index', [
            'groups' => Group::withCount(['members', 'songs'])->orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.groups.form', [
            'group' => new Group([
                'accent' => '#1a120c',
                'accent_ink' => '#e2a322',
                'sort_order' => (Group::max('sort_order') ?? 0) + 1,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        unset($data['slug']);
        $data['slug'] = Slug::unique($request->filled('slug') ? $request->string('slug')->toString() : $data['name'], 'groups');

        Group::create($data);

        return redirect()->route('admin.groups.index')->with('status', 'Group created.');
    }

    public function edit(Group $group): View
    {
        return view('admin.groups.form', compact('group'));
    }

    public function update(Request $request, Group $group): RedirectResponse
    {
        $data = $this->validated($request);
        unset($data['slug']);
        if ($request->filled('slug')) {
            $data['slug'] = Slug::unique($request->string('slug')->toString(), 'groups', $group->id);
        }

        $group->update($data);

        return redirect()->route('admin.groups.index')->with('status', 'Group updated.');
    }

    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();

        return redirect()->route('admin.groups.index')->with('status', 'Group deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:140'],
            'concept' => ['required', 'string', 'max:160'],
            'genre' => ['required', 'string', 'max:160'],
            'summary' => ['required', 'string', 'max:2000'],
            'accent' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'accent_ink' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'telegram_url' => ['required', 'url', 'max:500'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:255'],
        ]);
    }
}
