<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Member;
use App\Support\Slug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(Request $request): View
    {
        $groupId = $request->integer('group');

        return view('admin.members.index', [
            'groups' => Group::orderBy('sort_order')->get(),
            'groupId' => $groupId ?: null,
            'members' => Member::with('group')
                ->when($groupId, fn ($query) => $query->where('group_id', $groupId))
                ->orderBy('group_id')
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    public function create(Request $request): View
    {
        return view('admin.members.form', [
            'member' => new Member([
                'group_id' => $request->integer('group') ?: null,
                'sort_order' => 1,
            ]),
            'groups' => Group::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        unset($data['slug']);
        $data['slug'] = Slug::unique($request->filled('slug') ? $request->string('slug')->toString() : $data['name'], 'members');

        Member::create($data);

        return redirect()->route('admin.members.index', ['group' => $data['group_id']])->with('status', 'Member created.');
    }

    public function edit(Member $member): View
    {
        return view('admin.members.form', [
            'member' => $member,
            'groups' => Group::orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request, Member $member): RedirectResponse
    {
        $data = $this->validated($request);
        unset($data['slug']);
        if ($request->filled('slug')) {
            $data['slug'] = Slug::unique($request->string('slug')->toString(), 'members', $member->id);
        }

        $member->update($data);

        return redirect()->route('admin.members.index', ['group' => $member->group_id])->with('status', 'Member updated.');
    }

    public function destroy(Member $member): RedirectResponse
    {
        $groupId = $member->group_id;
        $member->delete();

        return redirect()->route('admin.members.index', ['group' => $groupId])->with('status', 'Member deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'group_id' => ['required', 'exists:groups,id'],
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:140'],
            'bio' => ['nullable', 'string', 'max:800'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:255'],
        ]);
    }
}
