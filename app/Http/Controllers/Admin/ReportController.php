<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AlumniProfile;
use App\Models\Event;

class ReportController extends Controller
{
    public function index()
    {
        $totalAlumni  = User::where('role', 'alumni')->count();
        $employed     = AlumniProfile::whereNotNull('employer')->count();
        $unemployed   = AlumniProfile::whereNull('employer')->count();

      
        $perBatch = AlumniProfile::selectRaw('batch_year, count(*) as total')
                                 ->groupBy('batch_year')
                                 ->orderBy('batch_year')
                                 ->get();


        $events = Event::withCount(['confirmedRsvps'])->get();

        return view('admin.reports.index', compact(
            'totalAlumni', 'employed', 'unemployed', 'perBatch', 'events'
        ));
    }
}