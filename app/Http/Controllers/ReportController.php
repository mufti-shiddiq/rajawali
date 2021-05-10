<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\DailyReport;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Container\RewindableGenerator;
use \Reportable\Traits\Reportable;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function transaction(Request $request)
    {
        $lastWeek = Carbon::now()->subWeek();

        if ($request->ajax()) {
            $data = Transaction::all();
            $modelCustomer = Transaction::with('customer_id');
            $modelUser = Transaction::with('user_id');

            return Datatables::of($data, $modelCustomer, $modelUser)
                ->addIndexColumn()

                ->addColumn('customer', function (Transaction $transaction) {
                    return $transaction->customer->name;
                })

                ->addColumn('user', function (Transaction $transaction) {
                    return $transaction->user->name;
                })

                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-info text-white btn-sm" href="' . route('reports.trx_detail', [$row->id]) . '">Detail</a>
                            <form action="' . route('reports.trx_destroy', [$row->id]) . '" class="d-inline" method="POST">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm(\'Yakin ingin menghapus?\')"><i class="fa fa-trash-alt"></i></a>
                            </form>';
                    return $btn;
                })
                ->rawColumns(['action', 'actions'])
                ->make(true);
        }

        return view('reports.transaction');
    }

    public function trx_detail($id)
    {
        Product::get('id', 'name');
        $transaction = \App\Models\Transaction::findOrFail($id);

        $trx_detail = \App\Models\TransactionDetail::where('transaction_id', $id)->get();

        // dd($trx_detail);
        // $productId = $trx_detail->product_id;


        // $productName = Product::where('id', $productId)->get('name');

        return view('reports.trx_detail', ['transaction' => $transaction, 'trx_detail' => $trx_detail], compact('id'));
    }

    public function trx_destroy($id)
    {
        $transaction = \App\Models\Transaction::findOrFail($id);
        $trxdetail = \App\Models\TransactionDetail::where('transaction_id', $id);
        $trxqty = \App\Models\TransactionDetail::where('transaction_id', $id)->sum('quantity');
        $trxnol = \App\Models\TransactionDetail::where('transaction_id', 0);

        $product = TransactionDetail::where('transaction_id', $id)->get();

        foreach ($product as $key => $row) {

            Product::where('id', $row->product_id)->increment('stock', $row->quantity);
            Product::where('id', $row->product_id)->decrement('sold', $row->quantity);
        }

        $report = DailyReport::whereDate('created_at', '=', ($transaction->created_at));
        $report->decrement('transaction', 1);
        $report->decrement('product', $trxqty);
        $report->decrement('value', $transaction->grand_total);
        $report->decrement('capital', $transaction->capital);
        $report->decrement('profit', $transaction->profit);

        $transaction->delete();
        $trxdetail->delete();
        $trxnol->delete();

        return redirect()->route('reports.transaction');
    }

    public function stock_in()
    {
        return view('reports.stock_in');
    }

    public function stock_out()
    {
        return view('reports.stock_out');
    }

    public function daily(Request $request)
    {

        $bulan = Carbon::now()->isoFormat('MMMM Y');

        // DATA HARI INI
        $todayTrx = Transaction::todayReport()->get();
        $todayTrxDetail = TransactionDetail::todayReport()->get();

        $countTrx = $todayTrx->count();
        $totalValueTrx = $todayTrx->sum('grand_total');
        $countTotalProduct = $todayTrxDetail->sum('quantity');
        $profit = $todayTrx->sum('profit');

        // DATA KEMARIN
        $ytdTrx = Transaction::yesterdayReport()->get();
        $ytdTrxDetail = TransactionDetail::yesterdayReport()->get();

        $countTrxYtd = $ytdTrx->count();
        $totalValueTrxYtd = $ytdTrx->sum('grand_total');
        $countTotalProductYtd = $ytdTrxDetail->sum('quantity');
        $profitYtd = $ytdTrx->sum('profit');

        // 

        $chartdata = [];
        $now = Carbon::now();
        // dd($now->day);

        /* CHART PROFIT */

        $trxprofit = Transaction::select(DB::raw("SUM(profit) as profit"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->firstOfMonth())
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();

        foreach ($trxprofit as $row) {
            $chartdata['profit_label'][] = $row->day;
            $chartdata['profit_data'][] = (int) $row->profit;
        }

        $trxvalue = Transaction::select(DB::raw("SUM(grand_total) as value"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->firstOfMonth())
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();

        foreach ($trxvalue as $row) {
            $chartdata['value_label'][] = $row->day;
            $chartdata['value_data'][] = (int) $row->value;
        }

        // dd($hari[]);

        /* CHART TRX */
        $trxcount = Transaction::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->firstOfMonth())
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();

        foreach ($trxcount as $row) {
            $chartdata['trx_label'][] = $row->day;
            $chartdata['trx_data'][] = (int) $row->count;
        }

        $chartdata['chart_data'] = json_encode($chartdata);

        // dd($chartdata['profit_data']);

        // $data = $chartdata['profit_data'];
        // $weeklyTrx = Transaction::thisWeekReport()->get();
        // dd($weeklyTrx);

        // $datas = $data->toArray();
        // dd($datas);

        /* DATATABLES */

        if ($request->ajax()) {
            $data = DailyReport::thisMonthReport()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }



        return view('reports.daily', compact('countTrx', 'totalValueTrx', 'countTotalProduct', 'profit', 'countTrxYtd', 'totalValueTrxYtd', 'countTotalProductYtd', 'profitYtd', 'bulan'), $chartdata);
    }

    public function daily2(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::todayReport()->get();
            $modelCustomer = Transaction::with('customer_id');
            $modelUser = Transaction::with('user_id');


            return Datatables::of($data, $modelCustomer, $modelUser)
                ->addIndexColumn()

                ->addColumn('customer', function (Transaction $transaction) {
                    return $transaction->customer->name;
                })

                ->addColumn('user', function (Transaction $transaction) {
                    return $transaction->user->name;
                })

                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-info text-white btn-sm" href="' . route('reports.trx_detail', [$row->id]) . '">Detail</a>
                            <form action="' . route('reports.trx_destroy', [$row->id]) . '" class="d-inline" method="POST">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</a>
                            </form>';
                    return $btn;
                })
                ->rawColumns(['action', 'actions'])
                ->make(true);
        }
    }

    public function weekly(Request $request)
    {
        // DATA THIS WEEK
        $weeklyTrx = Transaction::thisWeekReport()->get();
        $weeklyTrxDetail = TransactionDetail::thisWeekReport()->get();

        $countTrx = $weeklyTrx->count();
        $totalValueTrx = $weeklyTrx->sum('grand_total');
        $countTotalProduct = $weeklyTrxDetail->sum('quantity');
        $profit = $weeklyTrx->sum('profit');

        // DATA LAST WEEK
        $lastWeekTrx = Transaction::lastWeekReport()->get();
        $lastWeekTrxDetail = TransactionDetail::lastWeekReport()->get();

        $countTrxLw = $lastWeekTrx->count();
        $totalValueTrxLw = $lastWeekTrx->sum('grand_total');
        $countTotalProductLw = $lastWeekTrxDetail->sum('quantity');
        $profitLw = $lastWeekTrx->sum('profit');

        // CHART
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
        // dd($chartdata);

        // DATATABLES
        if ($request->ajax()) {
            $data = Transaction::thisWeekReport()->get();
            $modelCustomer = Transaction::with('customer_id');
            $modelUser = Transaction::with('user_id');


            return Datatables::of($data, $modelCustomer, $modelUser)
                ->addIndexColumn()

                ->addColumn('customer', function (Transaction $transaction) {
                    return $transaction->customer->name;
                })

                ->addColumn('user', function (Transaction $transaction) {
                    return $transaction->user->name;
                })

                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-info text-white btn-sm" href="' . route('reports.trx_detail', [$row->id]) . '">Detail</a>
                            <form action="' . route('reports.trx_destroy', [$row->id]) . '" class="d-inline" method="POST">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</a>
                            </form>';
                    return $btn;
                })
                ->rawColumns(['action', 'actions'])
                ->make(true);
        }

        return view('reports.weekly', compact('countTrx', 'totalValueTrx', 'countTotalProduct', 'profit', 'countTrxLw', 'totalValueTrxLw', 'countTotalProductLw', 'profitLw'), $chartdata);
    }

    public function monthly(Request $request)
    {
        // DATA THIS MONTH
        $monthlyTrx = Transaction::thisMonthReport()->get();
        $monthlyTrxDetail = TransactionDetail::thisMonthReport()->get();
        // dd($monthlyTrx);

        $countTrx = $monthlyTrx->count();
        $totalValueTrx = $monthlyTrx->sum('grand_total');
        $countTotalProduct = $monthlyTrxDetail->sum('quantity');
        $profit = $monthlyTrx->sum('profit');

        // DATA LAST MONTH
        $lastMonthTrx = Transaction::lastMonthReport()->get();
        $lastMonthTrxDetail = TransactionDetail::lastMonthReport()->get();

        $countTrxLm = $lastMonthTrx->count();
        $totalValueTrxLm = $lastMonthTrx->sum('grand_total');
        $countTotalProductLm = $lastMonthTrxDetail->sum('quantity');
        $profitLm = $lastMonthTrx->sum('profit');

        // CHART
        // CHART
        $chartdata = [];
        $now = Carbon::now();
        // $day = Carbon::now()->startOfWeek();
        // dd($day);

        /* CHART PROFIT */

        $trxprofit = Transaction::select(DB::raw("SUM(profit) as profit"), DB::raw("MONTHNAME(created_at) as month_name"), DB::raw("MONTH(created_at) as month"))
            ->where('created_at', '>', Carbon::now()->firstOfYear())
            ->groupBy('month_name', 'month')
            ->orderBy('month')
            ->get();

        foreach ($trxprofit as $row) {
            $chartdata['profit_label'][] = $row->month_name;
            $chartdata['profit_data'][] = (int) $row->profit;
        }

        $trxvalue = Transaction::select(DB::raw("SUM(grand_total) as value"), DB::raw("MONTHNAME(created_at) as month_name"), DB::raw("MONTH(created_at) as month"))
            ->where('created_at', '>', Carbon::now()->firstOfYear())
            ->groupBy('month_name', 'month')
            ->orderBy('month')
            ->get();

        foreach ($trxvalue as $row) {
            $chartdata['value_label'][] = $row->month_name;
            $chartdata['value_data'][] = (int) $row->value;
        }

        // dd($hari[]);

        /* CHART TRX */
        $trxcount = Transaction::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"), DB::raw("MONTH(created_at) as month"))
            ->where('created_at', '>', Carbon::now()->firstOfYear())
            ->groupBy('month_name', 'month')
            ->orderBy('month')
            ->get();

        foreach ($trxcount as $row) {
            $chartdata['trx_label'][] = $row->month_name;
            $chartdata['trx_data'][] = (int) $row->count;
        }

        $chartdata['chart_data'] = json_encode($chartdata);
        // dd($chartdata);

        // DATATABLES
        if ($request->ajax()) {
            $data = Transaction::thisMonthReport()->get();
            $modelCustomer = Transaction::with('customer_id');
            $modelUser = Transaction::with('user_id');


            return Datatables::of($data, $modelCustomer, $modelUser)
                ->addIndexColumn()

                ->addColumn('customer', function (Transaction $transaction) {
                    return $transaction->customer->name;
                })

                ->addColumn('user', function (Transaction $transaction) {
                    return $transaction->user->name;
                })

                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-info text-white btn-sm" href="' . route('reports.trx_detail', [$row->id]) . '">Detail</a>
                            <form action="' . route('reports.trx_destroy', [$row->id]) . '" class="d-inline" method="POST">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</a>
                            </form>';
                    return $btn;
                })
                ->rawColumns(['action', 'actions'])
                ->make(true);
        }

        return view('reports.monthly', compact('countTrx', 'totalValueTrx', 'countTotalProduct', 'profit', 'countTrxLm', 'totalValueTrxLm', 'countTotalProductLm', 'profitLm'), $chartdata);
    }
}
