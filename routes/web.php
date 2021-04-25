<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home')->middleware('auth');

Route::resource("users", UserController::class)->middleware('can:isAdmin');

Route::resource('categories', CategoryController::class)->middleware('auth');

Route::resource('units', UnitController::class)->middleware('auth');

Route::resource('customers', CustomerController::class)->middleware('auth');

Route::resource('suppliers', SupplierController::class)->middleware('auth');

Route::resource('products', ProductController::class)->middleware('auth');

// Route::resource('transactions', TransactionController::class)->middleware('auth');
Route::get('/transactions',[TransactionController::class, 'index'])->name('transaction.index');
Route::post('/transactions/add',[TransactionController::class, 'add'])->name('cart.store');
Route::post('/transactions/update',[TransactionController::class, 'update'])->name('cart.update');
Route::post('/transactions/remove',[TransactionController::class, 'remove'])->name('cart.remove');
Route::post('/transactions/clear',[TransactionController::class, 'clear'])->name('cart.clear');
Route::post('/transactions/process',[TransactionController::class, 'process'])->name('transaction.process');
Route::get('/transactions/success',[TransactionController::class, 'success'])->name('transaction.success');

Route::get('/reports/transaction',[ReportController::class, 'transaction'])->name('reports.transaction');