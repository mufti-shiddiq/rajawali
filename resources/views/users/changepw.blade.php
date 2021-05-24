@extends("adminlte::page")

@section("title") Ubah Password @endsection

@section('content_header')
<h1>Ubah Password</h1>
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
                <h3 class="card-title">Ubah Password <b>{{$user->name}}</b> ({{"@".$user->username}})</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.updatepw', [$user->id])}}" method="POST">
                @csrf
                <input type="hidden" value="PUT" name="_method">

                <div class="card-body">

                    <!-- <div class="form-group">
                        <label for="name">Name</label>
                        <input value="{{$user->name}}" class="form-control" placeholder="Full Name" type="text" name="name" id="name" disabled />
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value="{{$user->username}}" class="form-control" placeholder="Username" type="text" name="username" id="username" disabled />
                    </div> -->

                    <div class="form-group">
                        <label for="password">Password Baru <a class="text-danger">*</a></label>
                        <input class="form-control {{$errors->first('password') ? "is-invalid" : ""}}" placeholder="Password" type="password" name="password" id="password" />
                        <div class="invalid-feedback">
                            {{$errors->first('password')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password Baru <a class="text-danger">*</a></label>
                        <input class="form-control {{$errors->first('password_confirmation') ? "is-invalid" : ""}}" placeholder="Konfirmasi Password" type="password" name="password_confirmation" id="password_confirmation" />
                        <div class="invalid-feedback">
                            {{$errors->first('password_confirmation')}}
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