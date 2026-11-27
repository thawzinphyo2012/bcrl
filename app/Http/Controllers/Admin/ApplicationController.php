<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditionApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();
        if (! in_array($status, ['new', 'reviewed', 'archived'], true)) {
            $status = null;
        }

        return view('admin.applications.index', [
            'status' => $status,
            'applications' => AuditionApplication::query()
                ->when($status, fn ($query) => $query->where('status', $status))
                ->latest()
                ->paginate(20)
                ->withQueryString(),
        ]);
    }

    public function show(AuditionApplication $application): View
    {
        return view('admin.applications.show', compact('application'));
    }

    public function update(Request $request, AuditionApplication $application): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['new', 'reviewed', 'archived'])],
        ]);

        $application->update($data);

        return back()->with('status', 'Application status updated.');
    }

    public function destroy(AuditionApplication $application): RedirectResponse
    {
        $application->delete();

        return redirect()->route('admin.applications.index')->with('status', 'Application deleted.');
    }
}
