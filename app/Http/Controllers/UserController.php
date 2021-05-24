<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    // public function __construct(){
    //     $this->middleware(function($request, $next){
    //         if(Gate::allows('manage-users')) return $next($request);
    //         abort(403, 'Anda tidak memiliki hak akses');
    //     });
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\Models\User::paginate(10);
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
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
            "name" => "required|max:100",
            "username" => "required|min:3|max:20|unique:users",
            "role" => "required",
            "password" => "required",
            "password_confirmation" => "required|same:password"
        ])->validate();

        $new_user = new \App\Models\User;
        $new_user->name = $request->get('name');
        $new_user->username = $request->get('username');
        // $new_user->role = json_encode($request->get('role'));
        $new_user->role = $request->get('role');

        $new_user->password = \Hash::make($request->get('password'));

        $new_user->save();
        return redirect()->route('users.create')->with('status', 'User baru berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    public function changepw($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('users.changepw', ['user' => $user]);
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
        $user = \App\Models\User::findOrFail($id);

        \Validator::make($request->all(), [
            "name" => "required|max:100",
            "username" => "required|min:3|max:20|unique:users,username," . $user->id . ",id",
            "role" => "required",
        ])->validate();

        $user->name = $request->get('name');
        $user->username = $request->get('username');
        // $user->password = \Hash::make($request->get('password'));
        $user->role = $request->get('role');

        $user->save();
        return redirect()->route('users.edit', [$id])->with('status', 'User berhasil diedit');
    }

    public function updatepw(Request $request, $id)
    {
        \Validator::make($request->all(), [
            "password" => "required",
            "password_confirmation" => "required|same:password"
        ])->validate();

        $user = \App\Models\User::findOrFail($id);
        $user->password = \Hash::make($request->get('password'));

        $user->save();
        return redirect()->route('users.changepw', [$id])->with('status', 'Password berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User berhasil dihapus');
    }
}
