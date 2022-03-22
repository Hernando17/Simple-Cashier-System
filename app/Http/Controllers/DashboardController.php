<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function create_user()
    {
        return view('create_user');
    }

    public function create_useract(Request $request)
    {
        $request->validate([
            'level' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = [
            'level' => $request->level,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        User::create($data);
        return redirect()->route('user');
    }

    public function user()
    {
        $users = User::all();
        return view('user', compact('users'));
    }

    public function delete_user($id)
    {
        User::find($id)->delete();
        return redirect()->route('user');
    }

    public function edit_user($id)
    {
        $user = User::find($id);
        return view('edit_user', compact('user'));
    }

    public function edit_useract($id, Request $request)
    {
        $request->validate([
            'level' => 'required',
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $data = [
            'level' => $request->level,
            'name' => $request->name,
            'email' => $request->email,
        ];

        User::find($id)->update($data);
        return redirect()->route('user');
    }
}
