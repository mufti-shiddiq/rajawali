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
                        <label for="name">Nama Kategori</label>
                        <input class="form-control" value="{{$category->name}}" placeholder="Nama Kategori" type="text" name="name" id="name" />
                    </div>

                    <div class="form-group">
                        <label for="name">Slug Kategori</label>
                        <input class="form-control" value="{{$category->slug}}" placeholder="Slug Kategori" type="text" name="slug" id="slug" />
                    </div>

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