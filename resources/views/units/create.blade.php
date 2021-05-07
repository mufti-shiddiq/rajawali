@extends("adminlte::page")

@section("title") Buat Satuan Produk @endsection

@section('content_header')
<h1>Buat Satuan Produk Baru</h1>
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
                <h3 class="card-title">Buat Satuan Produk Baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-sm p-3" enctype="multipart/form-data" action="{{route('units.store')}}" method="POST">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <small class="text-muted"> (Misal: Kilogram, Liter, Lembar)</small>
                        <input class="form-control" placeholder="Nama Satuan Produk" type="text" name="name" id="name" />
                    </div>
                    <div class="form-group">
                        <label for="code">Unit</label>
                        <small class="text-muted"> (Misal: kg, ltr, lbr, pcs)</small>
                        <input class="form-control" placeholder="Unit" type="text" name="code" id="code" />
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <!-- <input class="btn btn-primary" type="submit" value="Save" /> -->
                    <button type="submit" class="btn btn-primary" value="Save">Simpan</button>
                    <a href="{{route('units.index')}}" class="btn btn-danger">Kembali</a>
                    <button type="reset" class="btn btn-flat">Reset</button>
                </div>
            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->
</div>
@endsection