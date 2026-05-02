<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ActivationController extends Controller
{
    public function showActivate()
    {
        return view('auth.activate');
    }

    public function activate(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email|unique:users',
            'name'                  => 'required|string|max:255',
            'student_id'            => 'required|string|max:50',
            'batch_year'            => 'required|integer|min:1900|max:' . date('Y'),
            'course'                => 'required|string|max:255',
            'password'              => 'required|min:8|confirmed',
            'terms'                 => 'required|accepted',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'alumni',
            'status'   => 'dormant',
        ]);

        AlumniProfile::create([
            'user_id'      => $user->id,
            'student_id'   => $request->student_id,
            'batch_year'   => $request->batch_year,
            'course'       => $request->course,
            'status'       => 'pending',
            'submitted_at' => now(),
        ]);

        return redirect()->route('login')->with('status', 'Activation submitted. Please wait for the admin approval before logging in.');
    }
}
