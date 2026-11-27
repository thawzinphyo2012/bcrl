<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuditionRequest;
use App\Models\AuditionApplication;
use App\Models\MemberReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuditionController extends Controller
{
    public function index(): View
    {
        return view('auditions.index', [
            'reviews' => MemberReview::latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('auditions.apply');
    }

    public function store(StoreAuditionRequest $request): RedirectResponse
    {
        AuditionApplication::create($request->safe()->only([
            'full_name',
            'age',
            'city',
            'contact',
            'email',
            'interest',
            'experience',
            'why',
            'demo_url',
        ]));

        return redirect()
            ->route('auditions.apply')
            ->with('status', 'Thank you. Your application has been received. The BCRL team reviews submissions and contacts selected applicants. ကျေးဇူးတင်ပါသည်။ လျှောက်လွှာကို လက်ခံရရှိပါပြီ။');
    }
}
