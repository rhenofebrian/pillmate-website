<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Tampilkan halaman form login
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'username' => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);

        User::create([
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'password' => bcrypt($request->password), // hash password
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
            return back()->withErrors(['email' => 'Email tidak ditemukan'])->onlyInput('email');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah'])->onlyInput('email');
        }

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
        if(!Auth::check()){
            return response()->json(['message'=>'user not authenticated'], 401);
        }
        $user = Auth::user();
        
        $user->delete();

        return redirect()->route('login.form')->with('success','Profil berhasil diperbarui');
    }
}
