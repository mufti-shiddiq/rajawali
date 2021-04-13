@extends("adminlte::page")

@section("title") Tambah Pelanggan @endsection

@section('content_header')
<h1>Tambah Pelanggan Baru</h1>
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
                <h3 class="card-title">Tambah Pelanggan Baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-sm p-3" enctype="multipart/form-data" action="{{route('customers.store')}}" method="POST">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input  class="form-control" placeholder="Nama Pelanggan" type="text" name="name" id="name" />
                    </div>
                    <div class="form-group">
                        <label for="company">Perusahaan</label>
                        <input  class="form-control" placeholder="Nama Perusahaan" type="text" name="company" id="company" />
                    </div>
                    <div class="form-group">
                        <label for="phone">Telepon</label>
                        <input  class="form-control" placeholder="Nomor Telepon" type="tel" name="phone" id="phone" />
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea  class="form-control" name="address" id="address" rows="3"></textarea>
                    </div>                   

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <!-- <input class="btn btn-primary" type="submit" value="Save" /> -->
                    <button type="submit" class="btn btn-primary" value="Save">Simpan</button>
                    <a href="{{route('customers.index')}}" class="btn btn-danger">Batal</a>
                    <button type="reset" class="btn btn-flat">Reset</button>
                </div>
            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->

    @endsection
