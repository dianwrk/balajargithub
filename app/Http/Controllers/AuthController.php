<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi Input Form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Alamat email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid (contoh: nama@domain.com).',
            'password.required' => 'Kata sandi tidak boleh kosong.',
        ]);

        $remember = $request->boolean('remember');

        // 2. Coba Autentikasi dengan Auth::attempt()
        if (Auth::attempt($credentials, $remember)) {
            // Regenerasi Session ID untuk keamanan dari serangan Session Fixation
            $request->session()->regenerate();

            return redirect()->intended('/dashboard')
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        // 3. Jika Autentikasi Gagal
        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan tidak cocok.',
        ])->onlyInput('email');
    }

    /**
     * Proses Logout Pengguna
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Bersihkan dan reset session & CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
