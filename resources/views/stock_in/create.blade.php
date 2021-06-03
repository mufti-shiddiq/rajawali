@extends("adminlte::page")

@section("title") Input Stock Masuk @endsection

@section('content_header')
<h1> Input Stock Masuk</h1>
@stop

@push('css')
@endpush

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
                <h3 class="card-title">Input Stok Masuk</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-sm p-3" enctype="multipart/form-data" action="{{route('stock_in.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="col">

                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Tanggal/Waktu <a class="text-danger">*</a></label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input value="{{old('datetime')}}" type="text" id="datetime" name="datetime" class="form-control datetimepicker-input {{$errors->first('datetime') ? "is-invalid": ""}}" data-target="#datetime" />
                                    <div class="input-group-append" data-target="#datetime" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    {{$errors->first('datetime')}}
                                </div>
                            </div>

                            <label>Produk <a class="text-danger">*</a></label>
                            <div class="form-group input-group">

                                <input value="{{old('id')}}" type="hidden" id="id" name="id">
                                <input value="{{old('code')}}" type="hidden" id="code" name="code">
                                <!-- <input type="hidden" id="price" name="price">
                                <input type="hidden" id="buyprice" name="buyprice">
                                <input type="hidden" id="stock" name="stock">
                                <b class="hidden"><a id="stockview"></a></b> -->


                                <input value="{{old('name')}}" type="text" id="name" name="name" class="form-control {{$errors->first('id') ? "is-invalid": ""}}" readonly>

                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#pilihProduk">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>

                                <div class="invalid-feedback">
                                    {{$errors->first('id')}}
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity <a class="text-danger">*</a></label>
                                <input value="{{old('quantity')}}" class="form-control {{$errors->first('quantity') ? "is-invalid": ""}}" type="number" name="quantity" id="quantity" />
                                <div class="invalid-feedback">
                                    {{$errors->first('quantity')}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">Keterangan</label>
                                <textarea class="form-control {{$errors->first('note') ? "is-invalid": ""}}" name="note" id="note" rows="3">{{old('note')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('note')}}
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
                        <a href="{{route('stock_in.index')}}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->

    <!-- Modal Pilih Produk -->
    <div class="modal fade" id="pilihProduk" tabindex="-1" role="dialog" aria-labelledby="pilihProdukTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pilihProdukTitle">Pilih Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-stripped table-hover bg-white product-table" id="product-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th></th>
                                            <th>Kode</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Satuan</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th></th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<!-- <script src="{{asset('js/product.js')}}"></script> -->

<script type="text/javascript">
    //Date and time picker
    $(function() {
        $('#datetime').datetimepicker({
            format: 'DD-MM-YYYY HH:mm',
            icons: {
                time: 'far fa-clock'
            },
            locale: 'id',
            // inline: true,
            sideBySide: true,
            use24hours: true
        });


    });
</script>

<script type="text/javascript">
    /******/
    (() => { // webpackBootstrap
        var __webpack_exports__ = {};
        /*!******************************!*\
          !*** ./resources/js/cart.js ***!
          \******************************/
        var productSelected = {};
        ajax: "{{ route('products.index') }}"

        function selectProductAction() {
            let uang = Intl.NumberFormat('id-ID');
            var selectedData = $(this).data();
            $('input#id').val(selectedData.id);
            $('input#code').val(selectedData.code);
            $('input#name').val(selectedData.name);
            $('.modal').modal('hide');
        }

        $(document).ready(function() {
            $('.product-table').DataTable({
                processing: true,
                serverSide: true,
                order: [3, "asc"],
                ajax: "{{ route('products.index') }}",
                columns: [{
                        "data": null,
                        "sortable": false,
                        render: function render(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        visible: false,
                        orderable: false,
                        searchable: false
                    }, {
                        data: 'code',
                        name: 'code',
                        orderable: false
                    }, {
                        data: 'product_name',
                        name: 'product_name',
                    }, {
                        data: 'category',
                        name: 'category.name',
                        orderable: false
                    }, {
                        data: 'unit',
                        name: 'unit.code',
                        orderable: false
                    }, {
                        data: 'stock',
                        name: 'stock',
                        orderable: false
                    }, {
                        data: 'sell_price',
                        name: 'sell_price',
                        render: $.fn.dataTable.render.number('.', '.', 0, ''),
                        orderable: false
                    },
                    {
                        data: 'buy_price',
                        name: 'buy_price',
                        visible: false,
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function render(data, type, row) {
                            return '<button data-id="' + row.id + '" data-code="' + row.code + '" data-name="' + row.product_name + '" class="btn btn-info text-white btn-sm btn-select-product">Pilih</button>';
                        }
                    }
                ]
            });
            $('.product-table').on('click', '.btn-select-product', selectProductAction);

        });

        $(function() {
            $('.product-table input[type=search]').focus();
        });



        /******/
    })();
</script>

@endpush