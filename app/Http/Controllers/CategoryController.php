<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = \App\Models\Category::paginate(10);

        $filterKeyword = $request->get('name');
        if ($filterKeyword) {
            $categories = \App\Models\Category::where(
                "name",
                "LIKE",
                "%$filterKeyword%"
            )->paginate(5);
        }

        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
        $new_category = new \App\Models\Category;
        $new_category->name = $name;
        $new_category->created_by = \Auth::user()->id;
        $new_category->slug = \Str::slug($name, '-');
        $new_category->save();
        return redirect()->route('categories.create')->with('status', 'Kategori baru berhasil dibuat');
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
        $category_to_edit = \App\Models\Category::findOrFail($id);

        return view('categories.edit', ['category' => $category_to_edit]);
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
        $slug = $request->get('slug');

        $category = \App\Models\Category::findOrFail($id);

        $category->name = $name;
        $category->slug = $slug;

        $category->updated_by = \Auth::user()->id;
        $category->slug = \Str::slug($name);
        $category->save();
        return redirect()->route('categories.edit', [$id])->with('status', 'Kategori berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('status', 'Kategori berhasil dihapus');
    }
}
