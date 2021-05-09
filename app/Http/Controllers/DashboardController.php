<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        // Saldo Kas
        $cash_in = DB::table("wallets")->sum('cash_in');
        $cash_out = DB::table("wallets")->sum('cash_out');
        $cash_balance = $cash_in - $cash_out;

        // Transaksi Hari ini
        $total_trx_today = Transaction::where('created_at', '>', Carbon::today())->count();
        $total_value_trx_today = Transaction::where('created_at', '>', Carbon::today())->sum('grand_total');
        $total_product_sell_today = TransactionDetail::where('created_at', '>', Carbon::today())->sum('quantity');
        $profit_today = TransactionDetail::dailyReport()->sum('profit');;
        // dd($total_product_sell_today);

        // Chart.js
        $year = ['2021', '2022', '2023', '2024', '2025'];
        $month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        $transaction = [];
        foreach ($year as $key => $value) {
            $transaction[] = Transaction::where(DB::raw("DATE_FORMAT(created_at, '%Y')"), $value)->count();
        }

        // 2
        $trx_month = Transaction::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');

        $trx_last_week = Transaction::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();

        // dd($trx_last_week);

        // $data = [];

        foreach ($trx_last_week as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
        }

        $data['chart_data'] = json_encode($data);

        // dd($trx_month, $transaction);
        // dd($data);

        // Product::find($id)->select('id')->get()->count();
        return view('dashboard', compact('total_produk', 'total_pelanggan', 'total_pengguna', 'cash_balance', 'total_trx_today', 'total_value_trx_today', 'total_product_sell_today', 'trx_month', 'profit_today'))->with('year', json_encode($year, JSON_NUMERIC_CHECK))->with('month', json_encode($month, JSON_NUMERIC_CHECK))->with('transaction', json_encode($transaction, JSON_NUMERIC_CHECK))->with($data);
    }
}
