<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use App\Models\Transaction;

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

    public function transaction()
    {
        $transactions = Transaction::all();
        return view('transaction', compact('transactions'));
    }

    public function create_transaction()
    {
        return view('create_transaction');
    }

    public function create_transactionact(Request $request)
    {
        $request->validate([
            'item' => 'required',
            'quantity' => 'required',
            'total' => 'required',
        ]);

        $data = [
            'item' => $request->item,
            'quantity' => $request->quantity,
            'total' => $request->price,
        ];

        Transaction::create($data);
    }

    public function transaction_paid()
    {
        Transaction::query()
            ->where('id', '<')
            ->each(function ($oldPost) {
                $newPost = $oldPost->replicate();
                $newPost->setTable('inventorys');
                $newPost->save();
            });
    }

    public function inventory()
    {
        $inventorys = Inventory::all();
        return view('inventory', compact('inventorys'));
    }

    public function create_inventory()
    {
        return view('create_inventory');
    }

    public function create_inventoryact(Request $request)
    {
        $request->validate([
            'item' => 'required',
            'price' => 'required',
        ]);

        $data = [
            'item' => $request->item,
            'price' => $request->price,
        ];

        Inventory::create($data);
        return redirect('/inventory');
    }
}
