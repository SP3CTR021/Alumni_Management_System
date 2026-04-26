<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('status', 'published')
                                     ->latest()
                                     ->get();

        return view('alumni.announcements.index', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        return view('alumni.announcements.show', compact('announcement'));
    }
}