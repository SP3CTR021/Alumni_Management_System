<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = User::where('role', 'alumni')->with('alumniProfile')->get();
        return view('admin.alumni.index', compact('alumni'));
    }

    public function create()
    {
        return view('admin.alumni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'course'     => 'nullable|string|max:100',
            'batch_year' => 'nullable|string|max:10',
            'department' => 'nullable|string|max:100',
            'student_id' => 'nullable|string|max:50',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make('password123'), // default password
            'role'     => 'alumni',
            'status'   => 'active',
        ]);

        AlumniProfile::create([
            'user_id'    => $user->id,
            'student_id' => $request->student_id,
            'course'     => $request->course,
            'batch_year' => $request->batch_year,
            'department' => $request->department,
        ]);

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni added successfully.');
    }

    public function edit(User $alumni)
    {
        $profile = $alumni->alumniProfile;
        return view('admin.alumni.edit', compact('alumni', 'profile'));
    }

    public function update(Request $request, User $alumni)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $alumni->id,
            'course'     => 'nullable|string|max:100',
            'batch_year' => 'nullable|string|max:10',
            'department' => 'nullable|string|max:100',
            'student_id' => 'nullable|string|max:50',
            'status'     => 'required|in:active,dormant,flagged',
        ]);

        $alumni->update([
            'name'   => $request->name,
            'email'  => $request->email,
            'status' => $request->status,
        ]);

        $alumni->alumniProfile()->updateOrCreate(
            ['user_id' => $alumni->id],
            [
                'student_id' => $request->student_id,
                'course'     => $request->course,
                'batch_year' => $request->batch_year,
                'department' => $request->department,
            ]
        );

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni updated successfully.');
    }

    public function destroy(User $alumni)
    {
        $alumni->delete();
        return redirect()->route('admin.alumni.index')->with('success', 'Alumni deleted successfully.');
    }
}