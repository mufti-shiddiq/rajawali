@extends("adminlte::page")

@section("title") Produk @endsection

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Produk</h1>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{route('products.create')}}" class="btn btn-primary">Tambah Produk Baru</a>
    </div>
</div>
@stop

@section("content")
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped table-hover bg-white" id="table">
            <thead>
                <tr>
                    <th style="width: 50px"><b>No</b></th>
                    <th><b>Kode</b></th>
                    <th><b>Nama Produk</b></th>
                    <th><b>Kategori</b></th>
                    <th><b>Satuan</b></th>
                    <th><b>Stok</b></th>
                    <th><b>Terjual</b></th>
                    <th><b>Harga Beli</b></th>
                    <th><b>Harga Jual</b></th>
                    <th style="width: 125px"><b></b></th>
                </tr>
            </thead>
            <tbody>
        @foreach($products as $product)
        <tr>
            <th class="leading-6 text-center whitespace-nowrap">{{$loop->iteration}}.</th>
            
            <td>{{$product->code}}</td>

            <td>{{$product->product_name}}</td>

            <td>{{$product->category->name}}</td>

            <td>{{$product->unit->name}}</td>

            <td>{{$product->stock}}</td>

            <td>{{$product->sold}}</td>

            <td>{{$product->buy_price}}</td>

            <td>{{$product->sell_price}}</td>

            <td>
                <a class="btn btn-info text-white btn-sm" href="{{route('products.edit', [$product->id])}}">Edit</a>

                <form onsubmit="return confirm('Yakin ingin menghapus Produk ini?')" class="d-inline" action="{{route('products.destroy', [$product->id])}}" method="POST">
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
                {{$products->appends(Request::all())->links()}}
            </td>
        </tr>
    </tfoot>
    
@endsection

