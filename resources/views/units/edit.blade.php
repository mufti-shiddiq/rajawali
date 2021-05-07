@extends("adminlte::page")

@section("title") Edit Satuan Produk @endsection

@section('content_header')
<h1>Edit Satuan Produk</h1>
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
                <h3 class="card-title">Edit Satuan Produk</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-sm p-3" enctype="multipart/form-data" action="{{route('units.update', [$unit->id])}}" method="POST">
                @csrf
                <input type="hidden" value="PUT" name="_method">

                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input class="form-control" value="{{$unit->name}}" placeholder="Nama Satuan Produk" type="text" name="name" id="name" />
                    </div>

                    <div class="form-group">
                        <label for="name">Unit</label>
                        <input class="form-control" value="{{$unit->code}}" placeholder="Unit" type="text" name="code" id="code" />
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <!-- <input class="btn btn-primary" type="submit" value="Save" /> -->
                    <button type="submit" class="btn btn-primary" value="Save">Simpan</button>
                    <a href="{{route('units.index')}}" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->
</div>
@endsection