<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = \App\Models\Customer::paginate(10);
        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
            "name" => "required|max:100||unique:customers",
            "company" => "nullable",
            "phone" => "nullable",
            "address" => "nullable",
        ])->validate();

        $name = $request->get('name');
        $company = $request->get('company');
        $phone = $request->get('phone');
        $address = $request->get('address');

        $new_customer = new \App\Models\customer;

        $new_customer->name = $name;
        $new_customer->company = $company;
        $new_customer->phone = $phone;
        $new_customer->address = $address;

        $new_customer->created_by = \Auth::user()->id;

        $new_customer->save();
        return redirect()->route('customers.create')->with('status', 'Pelanggan baru berhasil dibuat');
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
        $customer_to_edit = \App\Models\customer::findOrFail($id);

        return view('customers.edit', ['customer' => $customer_to_edit]);
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

        $customer = \App\Models\customer::findOrFail($id);

        \Validator::make($request->all(), [
            "name" => "required|max:100|unique:customers,name," . $customer->id . ",id",
            "company" => "nullable",
            "phone" => "nullable",
            "address" => "nullable",
        ])->validate();

        $customer->name = $name;
        $customer->company = $company;
        $customer->phone = $phone;
        $customer->address = $address;

        $customer->updated_by = \Auth::user()->id;

        $customer->save();
        return redirect()->route('customers.edit', [$id])->with('status', 'Pelanggan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = \App\Models\customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers.index')->with('status', 'Pelanggan berhasil dihapus');
    }
}
