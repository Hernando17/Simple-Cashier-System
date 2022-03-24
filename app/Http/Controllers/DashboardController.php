<?php

/* This is telling the PHP that the controllers are in the `App\Http\Controllers` folder. */

namespace App\Http\Controllers;

/* This is importing the models that we created in the `models` folder. */

use App\Models\Inventory;
use App\Models\User;
use App\Models\Transaction;


/* This is importing the request class from the HTTP package. */
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * This function returns the dashboard view with the data that is passed in
     * 
     * @return The dashboard view.
     */
    public function dashboard()
    {
        $data = [
            'user' => User::count(),
            'inventory' => Inventory::count(),
            'transaction' => Transaction::count(),
        ];

        return view('dashboard', compact('data'));
    }

    /**
     * This function creates a view that allows the user to create a new user
     * 
     * @return A view.
     */
    public function create_user()
    {
        return view('create_user');
    }

    /**
     * Create a new user
     * 
     * @param Request request the request object
     * 
     * @return Nothing, because the variable is not assigned.
     */
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

    /**
     * This function returns a view that displays all the users in the database
     * 
     * @return A view.
     */
    public function user()
    {
        $users = User::all();
        return view('user', compact('users'));
    }

    /**
     * Delete a user from the database
     * 
     * @param id The id of the user you want to delete.
     * 
     * @return Redirecting to the user route.
     */
    public function delete_user($id)
    {
        User::find($id)->delete();
        return redirect()->route('user');
    }

    /**
     * This function will allow us to edit a user's information
     * 
     * @param id The id of the user we want to edit.
     * 
     * @return The view is being returned.
     */
    public function edit_user($id)
    {
        $user = User::find($id);
        return view('edit_user', compact('user'));
    }

    /**
     * Update the user's level, name, and email
     * 
     * @param id The ID of the user you want to edit.
     * @param Request request The request object.
     * 
     * @return Nothing.
     */
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

    /**
     * This function returns a view of all the transactions in the database
     * 
     * @return A view.
     */
    public function transaction()
    {
        $transactions = Transaction::all();
        return view('transaction', compact('transactions'));
    }

    /**
     * This function creates a view that allows the user to create a transaction
     * 
     * @return A view.
     */
    public function create_transaction()
    {
        $inventory = Inventory::all();
        return view('create_transaction', compact('inventory'));
    }

    /**
     * Create a new transaction
     * 
     * @param Request request The request object.
     * 
     * @return Redirecting to the transaction page.
     */
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

    /**
     * Delete a transaction from the database
     * 
     * @param id The id of the transaction to be deleted.
     * 
     * @return Nothing.
     */
    public function delete_transaction($id)
    {
        Transaction::find($id)->delete();
        return redirect('/transaction');
    }

    /**
     * Clear the transaction table
     * 
     * @return Nothing.
     */
    public function transaction_clear()
    {
        Transaction::truncate();
        return redirect('/transaction');
    }

    /**
     * This function returns a view that displays all the inventorys in the database
     * 
     * @return A view.
     */
    public function inventory()
    {
        $inventorys = Inventory::all();
        return view('inventory', compact('inventorys'));
    }

    /**
     * This function creates a view that allows the user to create a new inventory item
     * 
     * @return A view.
     */
    public function create_inventory()
    {
        return view('create_inventory');
    }

    /**
     * Create a new inventory item
     * 
     * @param Request request The request object.
     * 
     * @return Nothing.
     */
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

    /**
     * This function will allow the user to edit an inventory item
     * 
     * @param id The id of the inventory we want to edit.
     * 
     * @return The view is being returned.
     */
    public function edit_inventory($id)
    {
        $inventory = Inventory::find($id);
        return view('edit_inventory', compact('inventory'));
    }

    /**
     * It updates the item and price of an inventory item.
     * 
     * @param id The id of the inventory item to be edited.
     * @param Request request The request object.
     * 
     * @return Redirecting to the inventory page.
     */
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

    /**
     * Delete an inventory item from the database
     * 
     * @param id The id of the inventory to delete.
     * 
     * @return Redirecting to the inventory page.
     */
    public function delete_inventory($id)
    {
        Inventory::find($id)->delete();
        return redirect('/inventory');
    }

    /**
     * This function prints all the transactions in the database
     * 
     * @return A view.
     */
    public function print_transaction()
    {
        $transaction = Transaction::all();

        return view('print_transaction', compact('transaction'));
    }
}
