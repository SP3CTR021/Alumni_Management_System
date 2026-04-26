<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniProfile;
use App\Models\User;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function index()
    {
        $activations = AlumniProfile::with('user')
            ->where('status', 'pending')
            ->latest('submitted_at')
            ->paginate(15);

        $stats = [
            'pending' => AlumniProfile::where('status', 'pending')->count(),
            'approved' => AlumniProfile::where('status', 'approved')->count(),
            'rejected' => AlumniProfile::where('status', 'rejected')->count(),
        ];

        return view('admin.activations.index', compact('activations', 'stats'));
    }

    public function show(AlumniProfile $profile)
    {
        // Only show pending and rejected profiles for review
        if (!in_array($profile->status, ['pending', 'rejected'])) {
            abort(403, 'This activation cannot be reviewed.');
        }

        return view('admin.activations.show', compact('profile'));
    }

    public function approve(Request $request, AlumniProfile $profile)
    {
        if ($profile->status === 'approved') {
            return back()->with('info', 'This account is already approved.');
        }

        $profile->update([
            'status' => 'approved',
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
        ]);

        // Update user status to active
        $profile->user->update(['status' => 'active']);

        return redirect()->route('admin.activations.index')
            ->with('success', 'Account approved! Alumni can now log in.');
    }

    public function reject(Request $request, AlumniProfile $profile)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:255',
        ]);

        if ($profile->status === 'rejected') {
            return back()->with('info', 'This account is already rejected.');
        }

        $profile->update([
            'status' => 'rejected',
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()->route('admin.activations.index')
            ->with('success', 'Account rejected.');
    }
}
