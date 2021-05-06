@extends("adminlte::page")

@section("title") Input Stock Masuk @endsection

@section('content_header')
<h1> Input Stock Masuk</h1>
@stop

@push('css')
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                                <label>Tanggal/Waktu</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="text" id="datetime" name="datetime" class="form-control datetimepicker-input" data-target="#datetime" />
                                    <div class="input-group-append" data-target="#datetime" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <label>Produk</label>
                            <div class="form-group input-group">

                                <input type="hidden" id="id" name="id">
                                <input type="hidden" id="code" name="code">

                                <input type="text" id="name" name="name" class="form-control" readonly>

                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#pilihProduk">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input class="form-control" type="number" name="quantity" id="quantity" />
                            </div>

                            <div class="form-group">
                                <label for="note">Keterangan</label>
                                <textarea class="form-control" name="note" id="note" rows="3"></textarea>
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

    @endsection

    @push('js')

    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>

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

    <script>
        var BASE_URL = "{{url('/')}}"
    </script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('js/cart.js')}}"></script>

    @endpush