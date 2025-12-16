<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW LOGIN FORM
    |--------------------------------------------------------------------------
    */
    public function loginForm()
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESS LOGIN
    |--------------------------------------------------------------------------
    */
    public function loginProses(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard'); // KUNCI UTAMA
        }

        return back()->withErrors([
            'email' => 'Email atau password salah'
        ])->withInput();
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
