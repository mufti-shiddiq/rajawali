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
                        <label for="name">Nama <a class="text-danger">*</a></label>
                        <input value="{{$user->name}}" class="form-control {{$errors->first('name') ? "is-invalid": ""}}" placeholder="Nama" type="text" name="name" id="name" />
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username">Username <a class="text-danger">*</a></label>
                        <input value="{{$user->username}}" class="form-control {{$errors->first('username') ? "is-invalid": ""}}" placeholder="Username" type="text" name="username" id="username" />
                        <div class="invalid-feedback">
                            {{$errors->first('username')}}
                        </div>
                    </div>

                    <!-- <label class="text-danger">TODO: Opsi ubah Role dan Status belum ada</label> -->

                    <div class="form-group">
                        <label for="">Role <a class="text-danger">*</a></label>
                        <select name="role" class="form-control {{$errors->first('role') ? "is-invalid": ""}}">
                            <option {{ ( $user->role == "ADMIN") ? 'selected' : '' }} name="role" id="ADMIN" value="ADMIN">Admin</option>
                            <option {{ ( $user->role == "STAFF") ? 'selected' : '' }} name="role" id="STAFF" value="STAFF">Staff</option>
                        </select>
                        <div class="invalid-feedback">
                            {{$errors->first('role')}}
                        </div>
                    </div>

                    <b class="text-danger">* Wajib diisi</b>

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
</div>
@endsection