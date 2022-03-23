<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data = [
            'user' => User::count(),
            'inventory' => Inventory::count(),
            'transaction' => Transaction::count(),
        ];

        return view('dashboard', compact('data'));
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
        $inventory = Inventory::all();
        return view('create_transaction', compact('inventory'));
    }

    public function create_transactionact(Request $request)
    {
        $id = $request->id_inventory;
        $inventory = Inventory::find($id);
        $price = $inventory->price;

        $request->validate([
            'id_inventory' => 'required',
            'quantity' => 'required',
            'discount' => 'required',
        ]);

        $data = [
            'id_inventory' => $request->id_inventory,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'total' => $price * $request->quantity - $request->discount,
        ];

        Transaction::create($data);
        return redirect('/transaction');
    }

    public function delete_transaction($id)
    {
        Transaction::find($id)->delete();
        return redirect('/transaction');
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

    public function edit_inventory($id)
    {
        $inventory = Inventory::find($id);
        return view('edit_inventory', compact('inventory'));
    }

    public function edit_inventoryact($id, Request $request)
    {
        $request->validate([
            'item' => 'required',
            'price' => 'required',
        ]);

        $data = [
            'item' => $request->item,
            'price' => $request->price,
        ];

        Inventory::find($id)->update($data);
        return redirect('/inventory');
    }

    public function delete_inventory($id)
    {
        Inventory::find($id)->delete();
        return redirect('/inventory');
    }

    public function print_transaction()
    {
        $transaction = Transaction::all();

        return view('print_transaction', compact('transaction'));
    }
}
