<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\PartnershipInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BusinessController extends Controller
{
    public function index(): View
    {
        return view('business');
    }

    public function store(StoreInquiryRequest $request): RedirectResponse
    {
        PartnershipInquiry::create($request->safe()->only([
            'name',
            'organization',
            'email',
            'phone',
            'service',
            'message',
        ]));

        return redirect()
            ->route('business.index')
            ->with('status', 'Thank you. The BCRL team has your inquiry and will reply if there is a fit.');
    }
}
