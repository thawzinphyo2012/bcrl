<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();
        if (! in_array($status, ['new', 'reviewed', 'archived'], true)) {
            $status = null;
        }

        return view('admin.inquiries.index', [
            'status' => $status,
            'inquiries' => PartnershipInquiry::query()
                ->when($status, fn ($query) => $query->where('status', $status))
                ->latest()
                ->paginate(20)
                ->withQueryString(),
        ]);
    }

    public function show(PartnershipInquiry $inquiry): View
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function update(Request $request, PartnershipInquiry $inquiry): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['new', 'reviewed', 'archived'])],
        ]);

        $inquiry->update($data);

        return back()->with('status', 'Inquiry status updated.');
    }

    public function destroy(PartnershipInquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('status', 'Inquiry deleted.');
    }
}
