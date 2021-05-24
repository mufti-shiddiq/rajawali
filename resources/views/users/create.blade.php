@extends("adminlte::page")

@section("title") Buat User Baru @endsection

@section('content_header')
<h1>Buat User Baru</h1>
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
                <h3 class="card-title">Buat User Baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" action="{{route('users.store')}}" method="POST">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input value="{{old('name')}}" class="form-control {{$errors->first('name') ? "is-invalid": ""}}" placeholder="Full Name" type="text" name="name" id="name" />
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value="{{old('username')}}" class="form-control {{$errors->first('username') ? "is-invalid" : ""}}" placeholder="Username" type="text" name="username" id="username" />
                        <div class="invalid-feedback">
                            {{$errors->first('username')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control {{$errors->first('password') ? "is-invalid" : ""}}" placeholder="Password" type="password" name="password" id="password" />
                        <div class="invalid-feedback">
                            {{$errors->first('password')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input class="form-control {{$errors->first('password_confirmation') ? "is-invalid" : ""}}" placeholder="Konfirmasi Password" type="password" name="password_confirmation" id="password_confirmation" />
                        <div class="invalid-feedback">
                            {{$errors->first('password_confirmation')}}
                        </div>
                    </div>

                    <!-- select -->
                    <!-- <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" class="form-control">
                            <option value=""> -- Pilih -- </option>
                            <option class="form-control {{$errors->first('role') ? "is-invalid" : "" }}" name="role[]" id="ADMIN" value="ADMIN">Admin</option>
                            <option class="form-control {{$errors->first('role') ? "is-invalid" : "" }}" name="role[]" id="STAFF" value="STAFF">Staff</option>
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role" class="form-control {{$errors->first('password_confirmation') ? "is-invalid" : ""}}">
                            <option value=""> -- Pilih -- </option>
                            <option class="form-control" name="role" id="ADMIN" value="ADMIN">Admin</option>
                            <option class="form-control" name="role" id="STAFF" value="STAFF">Staff</option>
                        </select>
                        <div class="invalid-feedback">
                            {{$errors->first('role')}}
                        </div>
                    </div>

                    <!-- <label for="">Role</label>
                <br>
                <input class="form-control {{$errors->first('roles') ? "is-invalid" : "" }}" type="checkbox" name="role[]" id="ADMIN" value="ADMIN">
                <label for="ADMIN">Administrator</label>

                <input class="form-control {{$errors->first('roles') ? "is-invalid" : "" }}" type="checkbox" name="role[]" id="STAFF" value="STAFF">
                <label for="STAFF">Staff</label> -->

                    <div class="invalid-feedback">
                        {{$errors->first('role')}}
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <!-- <input class="btn btn-primary" type="submit" value="Save" /> -->
                    <button type="submit" class="btn btn-primary" value="Save">Simpan</button>
                    <a href="{{route('users.index')}}" class="btn btn-danger">Kembali</a>
                    <button type="reset" class="btn btn-flat">Reset</button>
                </div>
            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->
</div>
@endsection