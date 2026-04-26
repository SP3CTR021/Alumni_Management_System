<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->alumniProfile;

        $upcomingEvents = Event::where('status', 'published')
            ->where('event_date', '>=', today())
            ->orderBy('event_date')
            ->take(3)
            ->get();

        $recentAnnouncements = Announcement::where('status', 'published')
            ->latest('published_at')
            ->latest('created_at')
            ->take(3)
            ->get();

        $profileChecks = [
            'Phone number' => filled($profile?->phone),
            'Address' => filled($profile?->address),
            'Civil status' => filled($profile?->civil_status),
            'Sex' => filled($profile?->sex),
            'Employer' => filled($profile?->employer),
            'Job title' => filled($profile?->job_title),
            'Industry' => filled($profile?->industry),
            'Employment type' => filled($profile?->employment_type),
            'LinkedIn profile' => filled($profile?->linkedin),
        ];

        $completedProfileFields = collect($profileChecks)->filter()->count();
        $totalProfileFields = count($profileChecks);
        $profileCompletion = $totalProfileFields > 0
            ? (int) round(($completedProfileFields / $totalProfileFields) * 100)
            : 0;

        return view('alumni.dashboard', [
            'profile' => $profile,
            'upcomingEvents' => $upcomingEvents,
            'recentAnnouncements' => $recentAnnouncements,
            'upcomingEventsCount' => Event::where('status', 'published')
                ->where('event_date', '>=', today())
                ->count(),
            'announcementsCount' => Announcement::where('status', 'published')->count(),
            'profileCompletion' => $profileCompletion,
            'missingProfileItems' => collect($profileChecks)
                ->filter(fn ($isComplete) => ! $isComplete)
                ->keys()
                ->values(),
        ]);
    }
}
