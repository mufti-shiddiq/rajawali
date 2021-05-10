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
        $hari = Carbon::now()->isoFormat('dddd');
        // dd($hari);

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

        // $trx_month = Transaction::select(DB::raw("COUNT(*) as count"))
        //     ->whereYear('created_at', date('Y'))
        //     ->groupBy(DB::raw("Month(created_at)"))
        //     ->pluck('count');

        $chartdata = [];
        $now = Carbon::now();
        // $day = Carbon::now()->startOfWeek();
        // dd($day);

        /* CHART PROFIT */

        $trxprofit = Transaction::select(DB::raw("SUM(profit) as profit"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::now()->startOfWeek())
            ->groupBy('day_name', 'day')
            ->orderBy('day_name')
            ->get();

        foreach ($trxprofit as $row) {
            $chartdata['profit_label'][] = $row->day_name;
            $chartdata['profit_data'][] = (int) $row->profit;
        }

        $trxvalue = Transaction::select(DB::raw("SUM(grand_total) as value"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::now()->startOfWeek())
            ->groupBy('day_name', 'day')
            ->orderBy('day_name')
            ->get();

        foreach ($trxvalue as $row) {
            $chartdata['value_label'][] = $row->day_name;
            $chartdata['value_data'][] = (int) $row->value;
        }

        // dd($hari[]);

        /* CHART TRX */
        $trxcount = Transaction::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::now()->startOfWeek())
            ->groupBy('day_name', 'day')
            ->orderBy('day_name')
            ->get();

        foreach ($trxcount as $row) {
            $chartdata['trx_label'][] = $row->day_name;
            $chartdata['trx_data'][] = (int) $row->count;
        }

        $chartdata['chart_data'] = json_encode($chartdata);

        // dd($trx_month, $transaction);
        // dd($chartdata);

        // Product::find($id)->select('id')->get()->count();
        return view('dashboard', compact('total_produk', 'total_pelanggan', 'total_pengguna', 'cash_balance', 'total_trx_today', 'total_value_trx_today', 'total_product_sell_today', 'profit_today'), $chartdata);
    }
}
