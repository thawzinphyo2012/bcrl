<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Models\AuditionApplication;
use App\Models\MemberReview;
use App\Models\PartnershipInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('studio.dashboard', [
            'applications' => AuditionApplication::latest()->take(40)->get(),
            'inquiries' => PartnershipInquiry::latest()->take(40)->get(),
            'reviews' => MemberReview::latest()->get(),
            'counts' => [
                'applications' => AuditionApplication::count(),
                'new_applications' => AuditionApplication::where('status', 'new')->count(),
                'inquiries' => PartnershipInquiry::count(),
            ],
        ]);
    }

    public function updateApplication(Request $request, AuditionApplication $application): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['new', 'reviewed', 'archived'])],
        ]);

        $application->update($data);

        return back()->with('status', 'Application updated.');
    }

    public function updateInquiry(Request $request, PartnershipInquiry $inquiry): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['new', 'reviewed', 'archived'])],
        ]);

        $inquiry->update($data);

        return back()->with('status', 'Inquiry updated.');
    }
}
