<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $products = Product::all();
        $total_produk = Product::count();
        $total_pelanggan = Customer::count();
        $total_pengguna = User::count();


        // Product::find($id)->select('id')->get()->count();
        return view('dashboard', compact('total_produk', 'total_pelanggan', 'total_pengguna'));
    }
}
