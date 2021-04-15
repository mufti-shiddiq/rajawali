@extends("adminlte::page")

@section("title") Tambah Produk @endsection

@section('content_header')
<h1>Tambah Produk Baru</h1>
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
                <h3 class="card-title">Tambah Produk Baru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-sm p-3" enctype="multipart/form-data" action="{{route('products.store')}}" method="POST">
                @csrf
                <div class="card-body">

                <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="product_name">Nama Produk</label>
                        <input  class="form-control" placeholder="Nama Produk" type="text" name="product_name" id="product_name" />
                    </div>
                    <div class="form-group">
                        <label for="code">Kode</label>
                        <input  class="form-control" placeholder="Kode Produk" type="text" name="code" id="code" />
                    </div>
                    
                    <!-- category -->
                    <div class="form-group">
                        <label for="category">Kategory Produk</label>
                        <select class="form-control" name="category" id="category">
                        <option>-- Pilih --</option>
                        @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        </select>
                    </div>

                    <!-- unit -->
                    <div class="form-group">
                        <label for="unit">Satuan</label>
                        <select class="form-control" name="unit" id="unit">
                        <option>-- Pilih --</option>
                        @foreach ($unit as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6 pl-5">
                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input  class="form-control" placeholder="Stok Produk" type="number" name="stock" id="stock" />
                    </div>
                    <div class="form-group">
                        <label for="buy_price">Harga Beli</label>
                        <input  class="form-control" placeholder="Harga Beli Produk" type="number" name="buy_price" id="buy_price" />
                    </div>
                    <div class="form-group">
                        <label for="sell_price">Harga Jual</label>
                        <input  class="form-control" placeholder="Harga Jual Produk" type="number" name="sell_price" id="sell_price" />
                    </div>
                                     
                </div>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <div class="float-right">
                    <button type="reset" class="btn btn-flat">Reset</button>
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
