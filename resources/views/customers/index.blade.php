@extends("adminlte::page")

@section("title") Pelanggan @endsection

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Pelanggan</h1>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{route('customers.create')}}" class="btn btn-primary">Tambah Pelanggan Baru</a>
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
                @foreach($customers as $customer)
                <tr>
                    <th class="leading-6 text-center whitespace-nowrap">{{$loop->iteration}}.</th>

                    <td>{{$customer->name}}</td>

                    <td>{{$customer->company}}</td>

                    <td>{{$customer->phone}}</td>

                    <td>{{$customer->address}}</td>

                    <td>
                        <a class="btn btn-info text-white btn-sm" href="{{route('customers.edit', [$customer->id])}}">Edit</a>

                        <form onsubmit="return confirm('Yakin ingin menghapus Pelanggan ini?')" class="d-inline" action="{{route('customers.destroy', [$customer->id])}}" method="POST">
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
                        {{$customers->appends(Request::all())->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection