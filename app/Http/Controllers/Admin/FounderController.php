<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Founder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FounderController extends Controller
{
    public function index(): View
    {
        return view('admin.founders.index', [
            'founders' => Founder::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.founders.form', [
            'founder' => new Founder([
                'sort_order' => (Founder::max('sort_order') ?? 0) + 1,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Founder::create($this->validated($request));

        return redirect()->route('admin.founders.index')->with('status', 'Founder created.');
    }

    public function edit(Founder $founder): View
    {
        return view('admin.founders.form', compact('founder'));
    }

    public function update(Request $request, Founder $founder): RedirectResponse
    {
        $founder->update($this->validated($request));

        return redirect()->route('admin.founders.index')->with('status', 'Founder updated.');
    }

    public function destroy(Founder $founder): RedirectResponse
    {
        $founder->delete();

        return redirect()->route('admin.founders.index')->with('status', 'Founder deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'role' => ['required', 'string', 'max:160'],
            'bio' => ['required', 'string', 'max:1000'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:255'],
        ]);
    }
}
