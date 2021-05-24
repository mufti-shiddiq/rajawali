@extends("adminlte::page")

@section("title") Edit Pelanggan @endsection

@section('content_header')
<h1>Edit Pelanggan</h1>
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
                <h3 class="card-title">Edit Pelanggan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-sm p-3" enctype="multipart/form-data" action="{{route('customers.update', [$customer->id])}}" method="POST">
                @csrf
                <input type="hidden" value="PUT" name="_method">

                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nama <a class="text-danger">*</a></label>
                        <input class="form-control {{$errors->first('name') ? "is-invalid": ""}}" value="{{$customer->name}}" placeholder="Nama Pelanggan" type="text" name="name" id="name" />
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company">Perusahaan</label>
                        <input class="form-control {{$errors->first('company') ? "is-invalid": ""}}" value="{{$customer->company}}" placeholder="Nama Perusahaan" type="text" name="company" id="company" />
                        <div class="invalid-feedback">
                            {{$errors->first('company')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telepon</label>
                        <input class="form-control {{$errors->first('phone') ? "is-invalid": ""}}" value="{{$customer->phone}}" placeholder="Nomor Telepon" type="tel" name="phone" id="phone" />
                        <div class="invalid-feedback">
                            {{$errors->first('phone')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control {{$errors->first('address') ? "is-invalid": ""}}" name="address" id="address" rows="3">{{$customer->address}}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('address')}}
                        </div>
                    </div>

                    <b class="text-danger">* Wajib diisi</b>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <!-- <input class="btn btn-primary" type="submit" value="Save" /> -->
                    <button type="submit" class="btn btn-primary" value="Save">Simpan</button>
                    <a href="{{route('customers.index')}}" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->
</div>

@endsection