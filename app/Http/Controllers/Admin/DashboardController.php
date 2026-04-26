<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\ImportBatch;
use App\Models\AlumniProfile;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlumni     = User::where('role', 'alumni')->count();
        $totalEvents     = Event::where('status', 'published')->count();
        $totalAnnouncements = Announcement::where('status', 'published')->count();
        $latestBatch     = ImportBatch::latest()->first();
        $pendingActivations = AlumniProfile::where('status', 'pending')->count();
        $recentPendingActivations = AlumniProfile::with('user')
            ->where('status', 'pending')
            ->latest('submitted_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalAlumni',
            'totalEvents',
            'totalAnnouncements',
            'latestBatch',
            'pendingActivations',
            'recentPendingActivations'
        ));
    }
}
