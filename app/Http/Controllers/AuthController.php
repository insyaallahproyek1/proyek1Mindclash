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

            return redirect('/dashboard');
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
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login');
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
