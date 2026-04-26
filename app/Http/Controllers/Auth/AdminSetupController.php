<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSetupController extends Controller
{
    public function create()
    {
        if (User::where('role', 'admin')->exists()) {
            return redirect()->route('login', ['admin' => 1])
                ->withErrors(['email' => 'An administrator account already exists.']);
        }

        return view('auth.setup-admin');
    }

    public function store(Request $request)
    {
        if (User::where('role', 'admin')->exists()) {
            return redirect()->route('login', ['admin' => 1])
                ->withErrors(['email' => 'An administrator account already exists.']);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
            'status' => 'active',
        ]);

        Auth::login($admin);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Administrator account created successfully.');
    }
}
