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

                    <div class="form-row pb-4">
                        <div class="col">
                            <h5>Kode Produk Terakhir Berdasarkan Kategori: </h5>
                            <!-- <b class="text-danger">{{$last_product->code}}</b> -->

                            <table class="table table-bordered bg-white">
                                <thead>
                                    <tr>
                                        @foreach ($last['category'] as $row)
                                        <th class="text-center">{{$row}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($last['code'] as $row)
                                        <td class="text-center text-info"><b>{{$row}}</b></td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>




                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="product_name">Nama Produk <a class="text-danger">*</a></label>
                                <input value="{{old('product_name')}}" class="form-control {{$errors->first('product_name') ? "is-invalid": ""}}" placeholder="Nama Produk" type="text" name="product_name" id="product_name" />
                                <div class="invalid-feedback">
                                    {{$errors->first('product_name')}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="code">Kode <a class="text-danger">*</a></label>
                                <input value="{{old('code')}}" class="form-control {{$errors->first('code') ? "is-invalid": ""}}" placeholder="Kode Produk" type="text" name="code" id="code" />
                                <div class="invalid-feedback">
                                    {{$errors->first('code')}}
                                </div>
                            </div>

                            <!-- category -->
                            <div class="form-group">
                                <label for="category_id">Kategory Produk <a class="text-danger">*</a></label>
                                <select value="{{old('category_id')}}" class="form-control {{$errors->first('category_id') ? "is-invalid": ""}}" name="category_id" id="category_id">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{$errors->first('category_id')}}
                                </div>
                            </div>

                            <!-- unit -->
                            <div class="form-group">
                                <label for="unit_id">Satuan <a class="text-danger">*</a></label>
                                <select value="{{old('unit_id')}}" class="form-control {{$errors->first('unit_id') ? "is-invalid": ""}}" name="unit_id" id="unit_id">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($unit as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{$errors->first('unit_id')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-6 pl-5">
                            <div class="form-group">
                                <label for="stock">Stok <a class="text-danger">*</a></label>
                                <input value="{{old('stock')}}" class="form-control {{$errors->first('stock') ? "is-invalid": ""}}" placeholder="Stok Produk" type="number" name="stock" id="stock" />
                                <div class="invalid-feedback">
                                    {{$errors->first('stock')}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="buy_price">Harga Beli <a class="text-danger">*</a></label>
                                <input value="{{old('buy_price')}}" class="form-control {{$errors->first('buy_price') ? "is-invalid": ""}}" placeholder="Harga Beli Produk" type="number" name="buy_price" id="buy_price" />
                                <div class="invalid-feedback">
                                    {{$errors->first('buy_price')}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sell_price">Harga Jual <a class="text-danger">*</a></label>
                                <input value="{{old('sell_price')}}" class="form-control {{$errors->first('sell_price') ? "is-invalid": ""}}" placeholder="Harga Jual Produk" type="number" name="sell_price" id="sell_price" />
                                <div class="invalid-feedback">
                                    {{$errors->first('sell_price')}}
                                </div>
                            </div>

                            <b class="text-danger">* Wajib diisi</b>

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <div class="float-right">
                        <button type="reset" class="btn btn-flat">Reset</button>
                        <!-- <input class="btn btn-primary" type="submit" value="Save" /> -->
                        <button type="submit" class="btn btn-primary" value="Save">Simpan</button>
                        <a href="{{route('products.index')}}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->
</div>
@endsection