@extends("adminlte::page")

@section("title") Kategori @endsection

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Kategori</h1>
    </div>
</div>
@stop

@section("content")

<div class="row">
    <div class="col-md-6">
        <form action="{{route('categories.index')}}">
            <div class="input-group">
                    <input type="text" class="form-control" placeholder="Filter berdasarkan nama kategori" name="name">
                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                    <div class="mx-5"></div>
            </div>
        </form>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{route('categories.create')}}" class="btn btn-primary">Buat Kategori Baru</a>
    </div>
    <hr class="my-3">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th style="width: 50px"><b>No</b></th>
                    <th><b>Name</b></th>
                    <th><b>Slug</b></th>
                    <th style="width: 200px"><b></b></th>
                </tr>
            </thead>
            <tbody>
        @foreach($categories as $category)
        <tr>
            <th class="leading-6 text-center whitespace-nowrap">{{$loop->iteration}}.</th>
            <td>{{$category->name}}</td>

            <td>{{$category->slug}}</td>

            <td>
                <a class="btn btn-info text-white btn-sm" href="{{route('categories.edit', [$category->id])}}">Edit</a>

                <form onsubmit="return confirm('Yakin ingin menghapus kategori ini?')" class="d-inline" action="{{route('categories.destroy', [$category->id])}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan=10>
                {{$categories->appends(Request::all())->links()}}
            </td>
        </tr>
    </tfoot>
    <hr class="my-3">
@endsection