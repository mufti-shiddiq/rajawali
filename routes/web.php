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
use App\Http\Controllers\WalletController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
});

Route::group(['middleware' => ['can:isAdmin']], function () {
    Route::resource("users", UserController::class);
    Route::get('/users/{id}/change_password', [UserController::class, 'changepw'])->name('users.changepw');
    Route::put('/users/{id}/update_password', [UserController::class, 'updatepw'])->name('users.updatepw');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('categories', CategoryController::class);

    Route::resource('units', UnitController::class);

    Route::resource('customers', CustomerController::class);

    Route::resource('suppliers', SupplierController::class);

    Route::resource('products', ProductController::class);
    Route::get('product-import-export', [ProductController::class, 'importExport'])->name('product-import-export');
    Route::post('product-import', [ProductController::class, 'import'])->name('product-import');
    Route::get('product-export', [ProductController::class, 'export'])->name('product-export');

    Route::resource('stock_in', StockInController::class)->middleware('auth');
    Route::resource('stock_out', StockOutController::class)->middleware('auth');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/transactions/add', [TransactionController::class, 'add'])->name('cart.store');
    Route::post('/transactions/update', [TransactionController::class, 'update'])->name('cart.update');
    Route::delete('/transactions/remove', [TransactionController::class, 'remove'])->name('cart.remove');
    Route::post('/transactions/clear', [TransactionController::class, 'clear'])->name('cart.clear');
    Route::post('/transactions/process', [TransactionController::class, 'process'])->name('transaction.process');
    Route::get('/transactions/success', [TransactionController::class, 'success'])->name('transaction.success');
    Route::get('/transactions/print/{id}', [TransactionController::class, 'print'])->name('transaction.print');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/reports/transaction', [ReportController::class, 'transaction'])->name('reports.transaction');
    Route::get('/reports/transaction/{id}', [ReportController::class, 'trx_detail'])->name('reports.trx_detail');
    Route::delete('/reports/transaction/{id}', [ReportController::class, 'trx_destroy'])->name('reports.trx_destroy');
    Route::get('/reports/stock_in', [ReportController::class, 'stock_in'])->name('reports.stock_in');
    Route::get('/reports/stock_out', [ReportController::class, 'stock_out'])->name('reports.stock_out');

    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/daily2', [ReportController::class, 'daily2'])->name('reports.daily2');
    Route::get('/reports/weekly', [ReportController::class, 'weekly'])->name('reports.weekly');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/wallets', [WalletController::class, 'index'])->name('wallets.index');
    Route::get('/wallets/add_cash_in', [WalletController::class, 'add_cash_in'])->name('wallets.add_cash_in');
    Route::get('/wallets/add_cash_out', [WalletController::class, 'add_cash_out'])->name('wallets.add_cash_out');
    Route::post('/wallets/store_cash_in', [WalletController::class, 'store_cash_in'])->name('wallets.store_cash_in');
    Route::post('/wallets/store_cash_out', [WalletController::class, 'store_cash_out'])->name('wallets.store_cash_out');
    Route::delete('/wallets/{id}', [WalletController::class, 'destroy'])->name('wallets.destroy');
});
