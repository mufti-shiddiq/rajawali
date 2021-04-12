<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = \App\Models\unit::paginate(5);
        return view('units.index', ['units' => $units]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("units.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
        $code = $request->get('code');
        
        $new_unit = new \App\Models\unit;

        $new_unit->name = $name;
        $new_unit->code = $code;
        $new_unit->created_by = \Auth::user()->id;

        $new_unit->save();
        return redirect()->route('units.create')->with('status', 'Satuan produk baru berhasil dibuat');
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
        $unit_to_edit = \App\Models\unit::findOrFail($id);

        return view('units.edit', ['unit' => $unit_to_edit]);
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
        $code= $request->get('code');

        $unit = \App\Models\unit::findOrFail($id);

        $unit->name = $name;
        $unit->code = $code;

        $unit->updated_by = \Auth::user()->id;
        
        $unit->save();
        return redirect()->route('units.edit', [$id])->with('status', 'Satuan produk berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = \App\Models\unit::findOrFail($id);
        $unit->delete();
        return redirect()->route('units.index')->with('status', 'Satuan produk berhasil dihapus');
    }
}