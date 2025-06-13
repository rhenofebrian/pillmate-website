<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'username' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        User::create([
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            // SIMPAN PASSWORD PLAIN TEXT
            'password' => $request->password,
        ]);

        return redirect()->route('login.form')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.',
            ])->onlyInput('email');
        }

        // Cek password plain text langsung
        if ($request->password !== $user->password) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        // Login user manual, bypass hash
        Auth::login($user);

        return redirect()->route('chatbot');
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile.show')
                ->withErrors($validator)
                ->withInput();
        }

        $user->username = $request->username;
        $user->phone_number = $request->phone_number;
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form')->with('success', 'Anda berhasil logout.');
    }
}
