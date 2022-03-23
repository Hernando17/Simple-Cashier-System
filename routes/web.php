<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



route::get('/', [AuthController::class, 'login'])->name('login');
route::post('/auth', [AuthController::class, 'authenticate'])->name('auth');
route::get('/logout', [AuthController::class, 'logout'])->name('logout');


route::middleware(['auth'])->group(function () {
    route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    route::get('/user', [DashboardController::class, 'user'])->name('user');
    route::get('/create_user', [DashboardController::class, 'create_user'])->name('create_user');
    route::post('/create_useract', [DashboardController::class, 'create_useract'])->name('create_useract');
    route::get('/delete_user/{id}', [DashboardController::class, 'delete_user'])->name('delete_user');
    route::get('/edit_user/{id}', [DashboardController::class, 'edit_user'])->name('edit_user');
    route::post('/edit_useract/{id}', [DashboardController::class, 'edit_useract'])->name('edit_useract');

    route::get('/transaction', [DashboardController::class, 'transaction'])->name('transaction');
    route::get('/create_transaction', [DashboardController::class, 'create_transaction'])->name('create_transaction');
    route::post('/create_transactionact', [DashboardController::class, 'create_transactionact'])->name('create_transactionact');
    route::get('/print_transaction', [DashboardController::class, 'print_transaction'])->name('print_transaction');
    route::get('/delete_transaction/{id}', [DashboardController::class, 'delete_transaction'])->name('delete_transaction');

    route::get('/inventory', [DashboardController::class, 'inventory'])->name('inventory');
    route::get('/create_inventory', [DashboardController::class, 'create_inventory'])->name('create_inventory');
    route::post('/create_inventoryact', [DashboardController::class, 'create_inventoryact'])->name('create_inventoryact');
    route::get('/edit_inventory/{id}', [DashboardController::class, 'edit_inventory'])->name('edit_inventory');
    route::post('/edit_inventoryact/{id}', [DashboardController::class, 'edit_inventoryact'])->name('edit_inventoryact');
    route::get('/delete_inventory/{id}', [DashboardController::class, 'delete_inventory'])->name('delete_inventory');
});
