<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * The constructor is called when a new instance of the class is created
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * This function is used to display the login page
     * 
     * @return A view.
     */
    public function login()
    {
        return view('index');
    }

    /**
     * If the user is authenticated, then the user is redirected to the dashboard. If the user is not
     * authenticated, then the user is redirected back to the login page with an error message
     * 
     * @param Request request The request object.
     * 
     * @return The user is redirected to the dashboard.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            if (Auth::user()->level == 'administrator') {
                $request->session()->put('administrator', true);
            } elseif (Auth::user()->level == 'cashier') {
                $request->session()->put('cashier', true);
            }

            return redirect()->intended('dashboard');
        }

        return back()->with('login_error', 'Wrong username or password');
    }

    /**
     * Logs out the user and clears the session
     * 
     * @param Request request The current request instance.
     * 
     * @return The user is being redirected to the home page.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
