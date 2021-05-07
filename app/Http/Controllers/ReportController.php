<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use \Reportable\Traits\Reportable;

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
                                    onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</a>
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
        $trxnol = \App\Models\TransactionDetail::where('transaction_id', 0);

        $product = TransactionDetail::where('transaction_id', $id)->get();

        foreach ($product as $key => $row) {

            Product::where('id', $row->product_id)->increment('stock', $row->quantity);
            Product::where('id', $row->product_id)->decrement('sold', $row->quantity);
        }

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
        $dailyTrx = Transaction::todayReport()->get();
        $dailyTrxDetail = TransactionDetail::todayReport()->get();

        $countTrx = $dailyTrx->count();
        $totalValueTrx = $dailyTrx->sum('grand_total');
        $countTotalProduct = $dailyTrxDetail->sum('quantity');
        $profit = $dailyTrxDetail->sum('profit');

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

        return view('reports.daily', compact('countTrx', 'totalValueTrx', 'countTotalProduct', 'profit'));
    }

    public function weekly(Request $request)
    {
        $weeklyTrx = Transaction::thisWeekReport()->get();
        $weeklyTrxDetail = TransactionDetail::thisWeekReport()->get();

        $countTrx = $weeklyTrx->count();
        $totalValueTrx = $weeklyTrx->sum('grand_total');
        $countTotalProduct = $weeklyTrxDetail->sum('quantity');
        $profit = $weeklyTrxDetail->sum('profit');

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

        return view('reports.weekly', compact('countTrx', 'totalValueTrx', 'countTotalProduct', 'profit'));
    }

    public function monthly(Request $request)
    {
        $monthlyTrx = Transaction::thisMonthReport()->get();
        $monthlyTrxDetail = TransactionDetail::thisMonthReport()->get();

        $countTrx = $monthlyTrx->count();
        $totalValueTrx = $monthlyTrx->sum('grand_total');
        $countTotalProduct = $monthlyTrxDetail->sum('quantity');
        $profit = $monthlyTrxDetail->sum('profit');

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

        return view('reports.monthly', compact('countTrx', 'totalValueTrx', 'countTotalProduct', 'profit'));
    }
}
