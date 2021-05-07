@extends("adminlte::page")

@section("title") Edit User @endsection

@section('content_header')
<h1>Edit User</h1>
@stop

@section("content")
<div class="row">
    <div class="col-md-5 mx-auto">

        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif

        <!-- general form elements -->
        <div class="card card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Edit User <b>{{$user->name}}</b> ({{"@".$user->username}})</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.update', [$user->id])}}" method="POST">
                @csrf
                <input type="hidden" value="PUT" name="_method">

                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input value="{{$user->name}}" class="form-control" placeholder="Full Name" type="text" name="name" id="name" />
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value="{{$user->username}}" class="form-control" placeholder="Username" type="text" name="username" id="username" />
                    </div>

                    <!-- <label class="text-danger">TODO: Jika form password kosong password tetap berubah</label>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" placeholder="Password" type="password" name="password" id="password" />
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Password Confirmation</label>
                        <input class="form-control {{$errors->first('password_confirmation') ? "is-invalid" : ""}}" placeholder="Password Confirmation" type="password" name="password_confirmation" id="password_confirmation" />
                        <div class="invalid-feedback">
                            {{$errors->first('password_confirmation')}}
                        </div>
                    </div> -->

                    <!-- <label class="text-danger">TODO: Opsi ubah Role dan Status belum ada</label> -->

                    <!-- select -->
                    <!-- {{-- <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" class="form-control">
                            <option {{in_array("ADMIN", json_decode($user->role)) ? "checked" : ""}} name="role[]" id="ADMIN" value="ADMIN">Admin</option>
                    <option {{in_array("STAFF", json_decode($user->role)) ? "checked" : ""}} name="role[]" id="STAFF" value="STAFF">Staff</option>
                    </select>
                </div> --}} -->

                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" class="form-control">
                            <option {{ ( $user->role == "ADMIN") ? 'selected' : '' }} name="role" id="ADMIN" value="ADMIN">Admin</option>
                            <option {{ ( $user->role == "STAFF") ? 'selected' : '' }} name="role" id="STAFF" value="STAFF">Staff</option>
                        </select>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">

                    <!-- <input class="btn btn-primary" type="submit" value="Save" /> -->
                    <button type="submit" class="btn btn-primary" value="Save">Simpan</button>
                    <a href="{{route('users.index')}}" class="btn btn-danger">Kembali</a>

                </div>

            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->

    @endsection