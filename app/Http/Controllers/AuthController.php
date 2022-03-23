<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login()
    {
        return view('index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            if (Auth::user()->level == 'admin') {
                $request->session()->put('admin', true);
            } elseif (Auth::user()->level == 'kasir') {
                $request->session()->put('kasir', true);
            }

            return redirect()->intended('dashboard');
        }

        return back()->with('login_error', 'Wrong username or password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
