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

route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
route::get('/user', [DashboardController::class, 'user'])->name('user');
route::get('/create_user', [DashboardController::class, 'create_user'])->name('create_user');
route::post('/create_useract', [DashboardController::class, 'create_useract'])->name('create_useract');
route::get('/delete_user/{id}', [DashboardController::class, 'delete_user'])->name('delete_user');
route::get('/edit_user/{id}', [DashboardController::class, 'edit_user'])->name('edit_user');
route::post('/edit_useract/{id}', [DashboardController::class, 'edit_useract'])->name('edit_useract');
