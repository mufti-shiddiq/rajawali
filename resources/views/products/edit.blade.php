@extends("adminlte::page")

@section("title") Edit Produk @endsection

@section('content_header')
<h1>Edit Produk</h1>
@stop

@section("content")
<div class="row">
    <div class="col-md-10 mx-auto">

        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif

        <!-- general form elements -->
        <div class="card card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Edit Produk</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-sm p-3" enctype="multipart/form-data" action="{{route('products.update', [$product->id])}}" method="POST">
                @csrf
                <input type="hidden" value="PUT" name="_method">

                <div class="card-body">
                <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="product_name">Nama Produk</label>
                        <input  class="form-control" value="{{$product->product_name}}" placeholder="Nama Produk" type="text" name="product_name" id="product_name" />
                    </div>
                    <div class="form-group">
                        <label for="code">Kode</label>
                        <input  class="form-control" value="{{$product->code}}" placeholder="Kode Produk" type="text" name="code" id="code" />
                    </div>
                    
                    <!-- category -->
                    <div class="form-group">
                        <label for="category_id">Kategory Produk</label>
                        <select class="form-control"  name="category_id" id="category_id">
                        <option value="{{ $product->category_id }}" selected>{{ $product->category->name }}</option>
                        @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        </select>
                    </div>

                    <!-- unit -->
                    <div class="form-group">
                        <label for="unit_id">Satuan</label>
                        <select class="form-control" value="{{ $product->unit_id }}" name="unit_id" id="unit_id">
                        <option value="{{ $product->unit_id }}" selected>{{ $product->unit->name }}</option>
                        @foreach ($unit as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6 pl-5">
                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input  class="form-control" value="{{$product->stock}}" placeholder="Stok Produk" type="number" name="stock" id="stock" />
                    </div>
                    <div class="form-group">
                        <label for="buy_price">Harga Beli</label>
                        <input  class="form-control" value="{{$product->buy_price}}" placeholder="Harga Beli Produk" type="number" name="buy_price" id="buy_price" />
                    </div>
                    <div class="form-group">
                        <label for="sell_price">Harga Jual</label>
                        <input  class="form-control" value="{{$product->sell_price}}" placeholder="Harga Jual Produk" type="number" name="sell_price" id="sell_price" />
                    </div>
                                     
                </div>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <div class="float-right">
                    <!-- <button type="reset" class="btn btn-flat">Reset</button> -->
                    <!-- <input class="btn btn-primary" type="submit" value="Save" /> -->
                    <button type="submit" class="btn btn-primary" value="Save">Simpan</button>
                    <a href="{{route('products.index')}}" class="btn btn-danger">Batal</a>
                </div>
                </div>
            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->

    @endsection
