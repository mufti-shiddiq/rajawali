<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockIn;
use Yajra\DataTables\Facades\DataTables;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = StockIn::all();
        // $modelProduct = StockIn::with('product_id');
        // dd($data);

        if ($request->ajax()) {
            $data = StockIn::all();
            $modelProduct = StockIn::with('product_id');

            return Datatables::of($data, $modelProduct)
                ->addIndexColumn()

                ->addColumn('code', function (StockIn $stock_in) {
                    return $stock_in->product->code;
                })

                ->addColumn('name', function (StockIn $stock_in) {
                    return $stock_in->product->product_name;
                })

                // ->addColumn('name', function (StockIn $stockIn) {
                //     return $stockIn->product->product_name;
                // })


                ->addColumn('action', function ($row) {
                    // $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    // $product = Product::all();

                    $btn = '<form action="' . route('stock_in.destroy', [$row->id]) . '" class="d-inline" method="POST">
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

        return view('stock_in.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock_in.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            "datetime" => "required",
            "id" => "required",
            "quantity" => "required",
            "note" => "nullable",
        ])->validate();

        $datetime = $request->get('datetime');
        $product_id = $request->get('id');
        $quantity = $request->get('quantity');
        $note = $request->get('note');


        // dd($note);
        // Store Data ke table transactions

        $new_stock_in = new \App\Models\StockIn();

        $new_stock_in->datetime = $datetime;
        $new_stock_in->product_id = $product_id;
        $new_stock_in->quantity = $quantity;
        $new_stock_in->note = $note;

        $new_stock_in->created_by = \Auth::user()->id;

        $new_stock_in->save();

        Product::where('id', $product_id)->increment('stock', $quantity);

        return redirect()->route('stock_in.create')->with('status', 'Stok Masuk berhasil diinput');
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

        Product::where('id', $product_id)->decrement('stock', $qty);

        $stockIn = \App\Models\StockIn::findOrFail($id);
        $stockIn->delete();

        return redirect()->route('stock_in.index');
    }
}
