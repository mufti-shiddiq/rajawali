<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $products = Product::with('category', 'unit')->paginate(5);
        // $product_code = Product::orderBy('code', 'DESC')->get();

        // return view('products.index', compact('products'));

        // dd($data = Product::all());

        if ($request->ajax()) {
            $data = Product::all();
            $modelCategory = Product::with('category_id');
            $modelUnit = Product::with('unit_id');

            return Datatables::of($data, $modelCategory, $modelUnit)
                ->addIndexColumn()

                ->addColumn('category', function (Product $product) {
                    return $product->category->name;
                })

                ->addColumn('unit', function (Product $product) {
                    return $product->unit->code;
                })

                ->addColumn('profit', function (Product $product) {
                    return $product->sell_price - $product->buy_price;
                })

                ->addColumn('action', function ($row) {
                    // $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    // $product = Product::all();

                    $btn = '<a class="btn btn-info text-white btn-sm" href="' . route('products.edit', [$row->id]) . '"><i class="fa fa-edit"></i></a>
                            
                                    <form action="' . route('products.destroy', [$row->id]) . '" class="d-inline" method="POST">
                                        ' . csrf_field() . '
                                        ' . method_field("DELETE") . '
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm(\'Yakin ingin menghapus Produk ini?\')"><i class="fa fa-trash-alt"></i></a>
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

        return view('products.index');

        // return view('products.index', ['products' => $products]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::all();
        $category = Category::all();
        $unit = Unit::all();

        $total_product = Product::count();

        $last = [];

        foreach ($category as $row) {
            if (Product::where('category_id', $row->id)->orderByDesc('created_at')->first() != null) {
                $last_code = Product::where('category_id', $row->id)->orderByDesc('id')->first('code');

                $last['category'][] = $row->name;
                $last['code'][] = $last_code->code;
            }
        }

        // dd($total_category);

        return view('products.create', compact('product', 'category', 'unit', 'total_product', 'last'));
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
            "product_name" => "required|max:50|unique:products",
            "code" => "required|min:3|max:20|unique:products",
            "category_id" => "required",
            "unit_id" => "required",
            "stock" => "required",
            "buy_price" => "required",
            "sell_price" => "required",
        ])->validate();

        $product_name = $request->get('product_name');
        $code = $request->get('code');
        $category_id = $request->get('category_id');
        $unit_id = $request->get('unit_id');
        $stock = $request->get('stock');
        $buy_price = $request->get('buy_price');
        $sell_price = $request->get('sell_price');

        $new_product = new \App\Models\Product;

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
        $category = Category::all();
        $unit = Unit::all();

        $product_to_edit = \App\Models\Product::findOrFail($id);

        return view('products.edit', ['product' => $product_to_edit], compact('category', 'unit'));
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

        $product = \App\Models\Product::findOrFail($id);

        \Validator::make($request->all(), [
            "product_name" => "required|max:50|unique:products,product_name," . $product->id . ",id",
            "code" => "required|min:3|max:20|unique:products,code," . $product->id . ",id",
            "category_id" => "required",
            "unit_id" => "required",
            "stock" => "required",
            "buy_price" => "required",
            "sell_price" => "required",
        ])->validate();

        $product->product_name = $product_name;
        $product->code = $code;
        $product->category_id = $category_id;
        $product->unit_id = $unit_id;
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
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('status', 'Produk berhasil dihapus');
    }


    // Import Export
    public function importExport()
    {
        return view('products.importExport');
    }

    public function import(Request $request)
    {
        Excel::import(new ProductsImport, $request->file('file')->store('temp'));
        return back();
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products-collection.xlsx');
    }
}
