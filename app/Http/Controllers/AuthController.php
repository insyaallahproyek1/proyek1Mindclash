<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ======================
    // TAMPILKAN LOGIN
    // ======================

    public function showLogin()
    {
        return view('auth.login');
    }

    // ======================
    // PROSES LOGIN
    // ======================

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // Redirect based on user role
            $user = auth()->user();
            if ($user && $user->role === 'admin') {
                return redirect('/dashboard');
            }

            return redirect('/quiz-home');
        }

        return back()->with(
            'error',
            'Email atau password salah!'
        );
    }

    // ======================
    // TAMPILKAN REGISTER
    // ======================

    public function showRegister()
    {
        return view('auth.register');
    }

    // ======================
    // PROSES REGISTER
    // ======================

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'class' => 'required|string|max:50',
            'password' => 'required|string|min:6',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'class.required' => 'Kelas wajib diisi.',
            'class.string' => 'Kelas harus berupa teks.',
            'class.max' => 'Kelas maksimal 50 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'class' => $validated['class'],
            'password' => Hash::make($validated['password'])
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // ======================
    // LOGOUT
    // ======================

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
        }
}
