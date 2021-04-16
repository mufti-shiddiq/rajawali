<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category', 'unit')->paginate(5);
        // $product_code = Product::orderBy('code', 'DESC')->get();

        return view('products.index', compact('products'));
        
        // return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = category::all();
        $unit = unit::all();
        return view('products.create', compact('category', 'unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_name = $request->get('product_name');
        $code = $request->get('code');
        $category_id = $request->get('category_id');
        $unit_id = $request->get('unit_id');
        $stock = $request->get('stock');
        $buy_price = $request->get('buy_price');
        $sell_price = $request->get('sell_price');
        
        $new_product = new \App\Models\product;

        $new_product->product_name = $product_name;
        $new_product->code = $code;
        $new_product->category_id = $category_id;
        $new_product->unit_id = $unit_id;
        $new_product->stock = $stock;
        $new_product->buy_price = $buy_price;
        $new_product->sell_price = $sell_price;

        $new_product->created_by = \Auth::user()->id;

        $new_product->save();
        return redirect()->route('products.create')->with('status', 'Produk baru berhasil dibuat');
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
        $product_to_edit = \App\Models\product::findOrFail($id);

        return view('products.edit', ['product' => $product_to_edit]);
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
        $product_name = $request->get('product_name');
        $code = $request->get('code');
        $category_id = $request->get('category_id');
        $unit_id = $request->get('unit_id');
        $stock = $request->get('stock');
        $buy_price = $request->get('buy_price');
        $sell_price = $request->get('sell_price');

        $product = \App\Models\product::findOrFail($id);

        $product->product_name = $product_name;
        $product->code = $code;
        $product->category = $category_id;
        $product->unit = $unit_id;
        $product->stock = $stock;
        $product->buy_price = $buy_price;
        $product->sell_price = $sell_price;

        $product->updated_by = \Auth::user()->id;
        
        $product->save();
        return redirect()->route('products.edit', [$id])->with('status', 'Produk berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = \App\Models\product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('status', 'Produk berhasil dihapus');
    }
}
