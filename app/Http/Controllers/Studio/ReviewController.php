<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Models\MemberReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80'],
            'group_name' => ['required', 'string', 'max:80'],
            'quote' => ['required', 'string', 'max:600'],
        ]);

        MemberReview::create($data);

        return back()->with('status', 'Member review published.');
    }

    public function destroy(MemberReview $review): RedirectResponse
    {
        $review->delete();

        return back()->with('status', 'Member review removed.');
    }
}
