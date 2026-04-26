<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Auth::user()->alumniProfile;
        return view('alumni.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'phone'           => 'nullable|string|max:20',
            'address'         => 'nullable|string|max:255',
            'civil_status'    => 'nullable|in:single,married,widowed,separated',
            'sex'             => 'nullable|in:male,female',
            'employer'        => 'nullable|string|max:255',
            'job_title'       => 'nullable|string|max:255',
            'industry'        => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:100',
            'linkedin'        => 'nullable|url|max:255',
        ]);

        $profile = Auth::user()->alumniProfile;

        if ($profile) {
            $profile->update($request->all());
        } else {
            AlumniProfile::create(array_merge(
                $request->all(),
                ['user_id' => Auth::id()]
            ));
        }

        return redirect()->route('alumni.profile.edit')->with('success', 'Profile updated successfully.');
    }
}