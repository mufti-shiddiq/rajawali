<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = \App\Models\Supplier::paginate(10);
        return view('suppliers.index', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
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
            "name" => "required|max:100||unique:suppliers",
            "company" => "nullable",
            "phone" => "nullable",
            "address" => "nullable",
        ])->validate();

        $name = $request->get('name');
        $company = $request->get('company');
        $phone = $request->get('phone');
        $address = $request->get('address');

        $new_supplier = new \App\Models\supplier;

        $new_supplier->name = $name;
        $new_supplier->company = $company;
        $new_supplier->phone = $phone;
        $new_supplier->address = $address;

        $new_supplier->created_by = \Auth::user()->id;

        $new_supplier->save();
        return redirect()->route('suppliers.create')->with('status', 'Supplier baru berhasil dibuat');
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
        $supplier_to_edit = \App\Models\supplier::findOrFail($id);

        return view('suppliers.edit', ['supplier' => $supplier_to_edit]);
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
        $name = $request->get('name');
        $company = $request->get('company');
        $phone = $request->get('phone');
        $address = $request->get('address');

        $supplier = \App\Models\supplier::findOrFail($id);

        \Validator::make($request->all(), [
            "name" => "required|max:100|unique:suppliers,name," . $supplier->id . ",id",
            "company" => "nullable",
            "phone" => "nullable",
            "address" => "nullable",
        ])->validate();

        $supplier->name = $name;
        $supplier->company = $company;
        $supplier->phone = $phone;
        $supplier->address = $address;

        $supplier->updated_by = \Auth::user()->id;

        $supplier->save();
        return redirect()->route('suppliers.edit', [$id])->with('status', 'Supplier berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = \App\Models\supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('status', 'Supplier berhasil dihapus');
    }
}
