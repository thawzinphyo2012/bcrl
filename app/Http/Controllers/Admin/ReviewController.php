<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(): View
    {
        return view('admin.reviews.index', [
            'reviews' => MemberReview::latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.reviews.form', [
            'review' => new MemberReview,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        MemberReview::create($this->validated($request));

        return redirect()->route('admin.reviews.index')->with('status', 'Review published.');
    }

    public function edit(MemberReview $review): View
    {
        return view('admin.reviews.form', compact('review'));
    }

    public function update(Request $request, MemberReview $review): RedirectResponse
    {
        $review->update($this->validated($request));

        return redirect()->route('admin.reviews.index')->with('status', 'Review updated.');
    }

    public function destroy(MemberReview $review): RedirectResponse
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('status', 'Review removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'group_name' => ['required', 'string', 'max:80'],
            'quote' => ['required', 'string', 'max:600'],
        ]);
    }
}
