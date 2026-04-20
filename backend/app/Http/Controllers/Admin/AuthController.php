<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\ActivityLogger;
use App\Support\Permissions;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create(): View
    {
        return view('admin.auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'is_active' => true], $request->boolean('remember'))) {
            return back()->withInput($request->only('email'))->withErrors([
                'email' => 'Email atau password tidak valid.',
            ]);
        }

        $request->session()->regenerate();
        $user = $request->user()->loadMissing('role');

        if (! $user->hasRole(Permissions::adminRoles())) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Akun ini tidak memiliki akses ke dashboard admin.',
            ]);
        }

        $user->forceFill(['last_login_at' => now()])->save();
        ActivityLogger::log('admin.login', 'Admin login melalui dashboard web.');

        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        ActivityLogger::log('admin.logout', 'Admin logout dari dashboard web.');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda berhasil logout.');
    }
}

