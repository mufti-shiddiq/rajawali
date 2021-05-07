@extends("adminlte::page")

@section("title") Supplier @endsection

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Supplier</h1>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{route('suppliers.create')}}" class="btn btn-primary">Tambah Supplier Baru</a>
    </div>
</div>
@stop

@section("content")
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped table-hover bg-white">
            <thead>
                <tr>
                    <th style="width: 50px"><b>No</b></th>
                    <th><b>Nama</b></th>
                    <th><b>Perusahaan</b></th>
                    <th><b>Telepon</b></th>
                    <th><b>Alamat</b></th>
                    <th style="width: 125px"><b></b></th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                <tr>
                    <th class="leading-6 text-center whitespace-nowrap">{{$loop->iteration}}.</th>

                    <td>{{$supplier->name}}</td>

                    <td>{{$supplier->company}}</td>

                    <td>{{$supplier->phone}}</td>

                    <td>{{$supplier->address}}</td>

                    <td>
                        <a class="btn btn-info text-white btn-sm" href="{{route('suppliers.edit', [$supplier->id])}}">Edit</a>

                        <form onsubmit="return confirm('Yakin ingin menghapus Supplier ini?')" class="d-inline" action="{{route('suppliers.destroy', [$supplier->id])}}" method="POST">
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
                        {{$suppliers->appends(Request::all())->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection