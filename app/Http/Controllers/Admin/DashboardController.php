<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditionApplication;
use App\Models\Founder;
use App\Models\Group;
use App\Models\Member;
use App\Models\MemberReview;
use App\Models\NewsPost;
use App\Models\PartnershipInquiry;
use App\Models\Song;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'groups' => Group::count(),
                'members' => Member::count(),
                'songs' => Song::count(),
                'news' => NewsPost::count(),
                'founders' => Founder::count(),
                'reviews' => MemberReview::count(),
                'applications' => AuditionApplication::count(),
                'new_applications' => AuditionApplication::where('status', 'new')->count(),
                'inquiries' => PartnershipInquiry::count(),
                'new_inquiries' => PartnershipInquiry::where('status', 'new')->count(),
            ],
            'applications' => AuditionApplication::latest()->take(5)->get(),
            'inquiries' => PartnershipInquiry::latest()->take(5)->get(),
            'songs' => Song::with('group')->latest('released_on')->take(5)->get(),
            'posts' => NewsPost::latest('published_at')->take(5)->get(),
        ]);
    }
}
