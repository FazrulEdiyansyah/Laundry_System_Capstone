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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('customer.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'whatsapp' => ['required', 'string', 'max:20'],        // Field baru
            'address' => ['required', 'string', 'max:500'],        // Field baru
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'whatsapp' => $validated['whatsapp'],      // Simpan whatsapp
            'address' => $validated['address'],        // Simpan address
            'password' => bcrypt($validated['password']),
            'role' => 'customer',
        ]);

        Auth::login($user);

        return redirect()->route('customer.dashboard');
    }
}
