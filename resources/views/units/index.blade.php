@extends("adminlte::page")

@section("title") Satuan Produk @endsection

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Satuan Produk</h1>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{route('units.create')}}" class="btn btn-primary">Buat Satuan Produk Baru</a>
    </div>
</div>
@stop

@section("content")
<div class="row">
    <div class="col-md-8">
        <table class="table table-bordered table-stripped table-hover bg-white">
            <thead>
                <tr>
                    <th style="width: 50px"><b>No</b></th>
                    <th><b>Nama</b></th>
                    <th style="width: 150px"><b>Unit</b></th>
                    <th style="width: 125px"><b></b></th>
                </tr>
            </thead>
            <tbody>
                @foreach($units as $unit)
                <tr>
                    <th class="leading-6 text-center whitespace-nowrap">{{$loop->iteration}}.</th>
                    <td>{{$unit->name}}</td>

                    <td>{{$unit->code}}</td>

                    <td>
                        <a class="btn btn-info text-white btn-sm" href="{{route('units.edit', [$unit->id])}}">Edit</a>

                        <form onsubmit="return confirm('Yakin ingin menghapus Satuan Produk ini?')" class="d-inline" action="{{route('units.destroy', [$unit->id])}}" method="POST">
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
                        {{$units->appends(Request::all())->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection