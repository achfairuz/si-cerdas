<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Tampilkan halaman login
    public function showLogin()
    {
        return view('pages.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        // Kalau user tidak ditemukan
        if (!$user) {

            Log::warning('Login gagal - Email tidak ditemukan', [
                'email' => $request->email,

            ]);

            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        // Cek password manual
        if (!Hash::check($request->password, $user->password)) {

            Log::warning('Login gagal - Password salah', [
                'email' => $request->email,

            ]);

            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        // Login berhasil
        Auth::login($user);
        session([
            'name' => $user->name,
            'email' => $user->email,
            'username' => $user->username ?? $user->name,
            'photo' => $user->photo ?? null,
        ]);

        $request->session()->regenerate();


        Log::info('Login berhasil', [
            'user_id' => $user->id,
            'email' => $user->email,

        ]);

        return redirect()->route('admin.dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Log::info('User logout', [
            'user_id' => Auth::id(),
            'email' => Auth::user()?->email,

        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}