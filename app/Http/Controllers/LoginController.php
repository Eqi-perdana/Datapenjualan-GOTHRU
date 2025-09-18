<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login user
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kredensial
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // proteksi session fixation
            $user = Auth::user();

            // cukup redirect ke satu route "dashboard"
            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil sebagai ' . ucfirst($user->role) . '!');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Proses logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}
    