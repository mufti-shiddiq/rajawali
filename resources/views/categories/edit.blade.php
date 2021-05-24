@extends("adminlte::page")

@section("title") Edit Kategori @endsection

@section('content_header')
<h1>Edit Kategori</h1>
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
                <h3 class="card-title">Edit Kategori</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-sm p-3" enctype="multipart/form-data" action="{{route('categories.update', [$category->id])}}" method="POST">
                @csrf
                <input type="hidden" value="PUT" name="_method">

                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nama Kategori <a class="text-danger">*</a></label>
                        <input class="form-control {{$errors->first('name') ? "is-invalid": ""}}" value="{{$category->name}}" placeholder="Nama Kategori" type="text" name="name" id="name" />
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug Kategori <a class="text-danger">*</a></label>
                        <input class="form-control {{$errors->first('slug') ? "is-invalid": ""}}" value="{{$category->slug}}" placeholder="Slug Kategori" type="text" name="slug" id="slug" />
                        <div class="invalid-feedback">
                            {{$errors->first('slug')}}
                        </div>
                    </div>

                    <b class="text-danger">* Wajib diisi</b>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <!-- <input class="btn btn-primary" type="submit" value="Save" /> -->
                    <button type="submit" class="btn btn-primary" value="Save">Simpan</button>
                    <a href="{{route('categories.index')}}" class="btn btn-danger">Kembali</a>
                </div>
            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->
</div>
@endsection