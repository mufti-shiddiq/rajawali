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

class ReportController extends Controller
{
    public function transaction(Request $request)
    {
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


                ->addColumn('date', function ($data) {
                    return $data->created_at;
                })

                ->addColumn('action', function ($row) {
                    // $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    // $product = Product::all();

                    $btn = '<a class="btn btn-info text-white btn-sm" href="' . route('reports.trx_detail', [$row->id]) . '">Detail</a>
                            
                                    <form action="' . route('reports.trx_destroy', [$row->id]) . '" class="d-inline" method="POST">
                                        ' . csrf_field() . '
                                        ' . method_field("DELETE") . '
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</a>
                                    </form>';

                    // $btn = $btn.'<form onsubmit="return confirm(Yakin ingin menghapus Produk ini?)" class="d-inline" action="'.route('products.destroy', [$row->id]).'" method="POST">
                    //             <input type="hidden" name="_method" value="DELETE">
                    //             <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                    //         </form>';

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
        $transaction->delete();
        return redirect()->route('reports.transaction');
    }
}
