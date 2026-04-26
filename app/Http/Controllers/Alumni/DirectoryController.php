<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;

class DirectoryController extends Controller
{
    public function index(Request $request)
    {
        $query = AlumniProfile::with('user')
            ->orderByDesc('batch_year')
            ->orderBy('course')
            ->orderBy('id');

        if ($search = $request->filled('q') ? trim($request->q) : null) {
            $query->where(function ($subquery) use ($search) {
                $subquery->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhere('course', 'like', "%{$search}%")
                ->orWhere('batch_year', 'like', "%{$search}%")
                ->orWhere('employer', 'like', "%{$search}%")
                ->orWhere('job_title', 'like', "%{$search}%");
            });
        }

        if ($request->filled('batch') && $request->batch !== 'all') {
            $query->where('batch_year', $request->batch);
        }

        if ($request->filled('course') && $request->course !== 'all') {
            $query->where('course', $request->course);
        }

        $profiles = $query->paginate(12)->withQueryString();

        $batches = AlumniProfile::select('batch_year')
            ->distinct()
            ->orderByDesc('batch_year')
            ->pluck('batch_year');

        $courses = AlumniProfile::select('course')
            ->distinct()
            ->orderBy('course')
            ->pluck('course');

        return view('alumni.directory', [
            'profiles' => $profiles,
            'batches' => $batches,
            'courses' => $courses,
        ]);
    }
}
