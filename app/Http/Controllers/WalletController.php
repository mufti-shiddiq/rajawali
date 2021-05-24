<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Wallet;
use Yajra\DataTables\Facades\DataTables;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cash_in = DB::table("wallets")->sum('cash_in');
        $cash_out = DB::table("wallets")->sum('cash_out');

        $balance = $cash_in - $cash_out;

        $last_cash_in = Wallet::where('transaction', "Kas-Masuk")->latest()->first();
        $last_ci_value = $last_cash_in->cash_in;
        $last_ci_note = $last_cash_in->note;

        $last_cash_out = Wallet::where('transaction', "Kas-Keluar")->latest()->first();
        $last_co_value = $last_cash_out->cash_out;
        $last_co_note = $last_cash_out->note;

        // dd($last_co_note);

        if ($request->ajax()) {
            $data = Wallet::all();

            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    // $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    // $product = Product::all();

                    $btn = '<form action="' . route('wallets.destroy', [$row->id]) . '" class="d-inline" method="POST">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm(\'Yakin ingin menghapus catatan kas ini?\')"><i class="fa fa-trash-alt"></i></a>
                            </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('wallets.index', compact(
            'cash_in',
            'cash_out',
            'balance',
            'last_cash_in',
            'last_cash_out',
            'last_ci_value',
            'last_co_value',
            'last_ci_note',
            'last_co_note'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('wallets.create');
    }

    public function add_cash_in()
    {
        return view('wallets.add_cash_in');
    }

    public function add_cash_out()
    {
        return view('wallets.add_cash_out');
    }

    public function store_cash_in(Request $request)
    {
        \Validator::make($request->all(), [
            "transaction" => "required",
            "datetime" => "required",
            "cash_in" => "required",
            "note" => "nullable",
        ])->validate();

        $new_wallet = new \App\Models\Wallet;
        // $new_wallet->transaction = json_encode($request->get('transaction'));
        $new_wallet->transaction = $request->get('transaction');
        $new_wallet->datetime = $request->get('datetime');
        $new_wallet->cash_in = $request->get('cash_in');
        $new_wallet->note = $request->get('note');

        $new_wallet->created_by = \Auth::user()->name;

        $new_wallet->save();
        return redirect()->route('wallets.add_cash_in')->with('status', 'Kas Masuk berhasil ditambahkan');
    }

    public function store_cash_out(Request $request)
    {
        \Validator::make($request->all(), [
            "transaction" => "required",
            "datetime" => "required",
            "cash_out" => "required",
            "note" => "nullable",
        ])->validate();

        $new_wallet = new \App\Models\Wallet;
        // $new_wallet->transaction = json_encode($request->get('transaction'));
        $new_wallet->transaction = $request->get('transaction');
        $new_wallet->datetime = $request->get('datetime');
        $new_wallet->cash_out = $request->get('cash_out');
        $new_wallet->note = $request->get('note');

        $new_wallet->created_by = \Auth::user()->name;

        $new_wallet->save();
        return redirect()->route('wallets.add_cash_out')->with('status', 'Kas Keluar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wallet = \App\Models\Wallet::findOrFail($id);
        $wallet->delete();
        return redirect()->route('wallets.index')->with('status', 'Catatan Kas berhasil dihapus');
    }
}
