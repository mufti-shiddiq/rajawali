<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockOut;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StockOut::all();
            $modelProduct = StockOut::with('product_id');

            return Datatables::of($data, $modelProduct)
                ->addIndexColumn()

                ->addColumn('code', function (StockOut $stock_out) {
                    return $stock_out->product->code;
                })

                ->addColumn('name', function (StockOut $stock_out) {
                    return $stock_out->product->product_name;
                })

                ->addColumn('action', function ($row) {


                    $btn = '<form action="' . route('stock_out.destroy', [$row->id]) . '" class="d-inline" method="POST">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <input type="hidden" id="product_id" name="product_id" value="' . $row->product_id . '">
                                <input type="hidden" id="qty" name="qty" value="' . $row->quantity . '">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm(\'Yakin ingin menghapus?\')"><i class="fa fa-trash-alt"></i></a>
                            </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('stock_out.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock_out.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datetime = $request->get('datetime');
        $product_id = $request->get('id');
        $quantity = $request->get('quantity');
        $note = $request->get('note');


        // dd($note);
        // Store Data ke table transactions

        $new_stock_in = new \App\Models\StockOut();

        $new_stock_in->datetime = $datetime;
        $new_stock_in->product_id = $product_id;
        $new_stock_in->quantity = $quantity;
        $new_stock_in->note = $note;

        $new_stock_in->created_by = \Auth::user()->id;

        $new_stock_in->save();

        Product::where('id', $product_id)->decrement('stock', $quantity);

        return redirect()->route('stock_out.create')->with('status', 'Stok Keluar berhasil diinput');
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
    public function destroy($id, Request $request)
    {
        $product_id = $request->get('product_id');
        $qty = $request->get('qty');

        // dd($product_id, $qty);

        Product::where('id', $product_id)->increment('stock', $qty);

        $stockOut = \App\Models\StockOut::findOrFail($id);
        $stockOut->delete();
        return redirect()->route('stock_out.index');
    }
}
