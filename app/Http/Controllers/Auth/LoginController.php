<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin(Request $request)
    {
        $hasAdminAccount = User::where('role', 'admin')->exists();

        if ($request->boolean('admin') && ! $hasAdminAccount) {
            return redirect()->route('admin.setup.create');
        }

        return view('auth.login', [
            'isAdminLogin' => $request->boolean('admin'),
            'hasAdminAccount' => $hasAdminAccount,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
            'login_role'=> 'required|in:admin,alumni',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $loginRole = $request->input('login_role', 'alumni');

            if ($loginRole === 'admin' && $user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors(['email' => 'This login page is for administrators only.']);
            }

            if ($loginRole === 'alumni' && $user->role === 'admin') {
                Auth::logout();
                return back()->withErrors(['email' => 'Administrator accounts must sign in through the admin login page.']);
            }

            // Check alumni-specific status
            if ($user->role === 'alumni') {
                $profile = $user->alumniProfile;

                if (!$profile) {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Alumni profile not found. Please contact support.']);
                }

                if ($profile->status === 'pending') {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Your account is pending admin approval. Please check back soon.']);
                }

                if ($profile->status === 'rejected') {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Your account was not approved. Please contact the admin office.']);
                }

                if ($profile->status !== 'approved') {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Your account status is invalid. Please contact support.']);
                }
            }

            // Block dormant or flagged accounts
            if ($user->status !== 'active') {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account is not yet active. Please activate it first.']);
            }

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('alumni.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
