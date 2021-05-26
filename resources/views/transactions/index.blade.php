@extends("adminlte::page")

@section("title") Transaksi @endsection

@push('css')
@endpush

@section('classes_body') sidebar-collapse @endsection

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Transaksi</h1>
    </div>
</div>
@stop

@section("content")

<div class="row">
    <div class="col-lg-4 pr-3">

        <div class="card">
            <div class="card-body">
                <div class="box box-widget">

                    <div class="box-body">

                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <table width="100%">
                                <tr>
                                    <td style="vertical-align: center; width:30%">
                                        <label for="code">Produk <a class="text-danger">*</a></label>
                                    </td>
                                    <td>
                                        <div class="form-group input-group">
                                            <!-- <input type="hidden" id="item_id"> -->
                                            <!-- <input id="price" type="text" > -->
                                            <!-- <input type="hidden" id="stock"> -->
                                            <!-- <input id="product_name" type="text"> -->
                                            <!-- <input id="code" type="text" class="form-control" autofocus> -->

                                            <input type="hidden" id="id" name="id">
                                            <input type="hidden" id="code" name="code">
                                            <!-- <input type="hidden" id="unit" name="unit"> -->
                                            <input type="hidden" id="price" name="price">
                                            <input type="hidden" id="buyprice" name="buyprice">

                                            <input type="text" id="name" name="name" class="form-control {{$errors->first('name') ? "is-invalid": ""}}" readonly>

                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#pilihProduk">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:center;width:30%">
                                        <label>Diskon Item</label>
                                    </td>
                                    <td style="">
                                        <div class="input-group">
                                            <input type="text" id="price_view" name="price_view" min="0" class="form-control" readonly>
                                            <label class="px-3"><b> _ </b></label>
                                            <input type="number" id="discount_item" name="discount_item" min="0" class="form-control {{$errors->first('discount_item') ? "is-invalid": ""}}">
                                            <!-- <div class="px-5"></div> -->
                                            <!-- <div class="px-2"></div> -->
                                            <!-- <input type="text" class="form-control" style="display: none;" id="unit" name="unit" disabled> -->
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:center;" class="pt-3">
                                        <label>Quantity <a class="text-danger">*</a></label>
                                    </td>
                                    <td>
                                        <div class="input-group pt-3">
                                            <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control {{$errors->first('quantity') ? "is-invalid": ""}}">
                                            <!-- <div class="text-info px-2"></div>
                                            <div class="px-3"><a id="unit" name="unit"></a></div> -->
                                            <input type="text" class="form-control" id="unit" name="unit" readonly>
                                            <div class="px-2"></div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-cart-plus"></i> Tambah
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <br>
                        <div>
                            <!-- <h4>Invoice <b><span id="invoice"></span></b></h4> -->
                            <h1><b style="font-size: 20pt;">Total: <span class="grand_total" id="grand_total2" style="font-size: 35pt;">{{ number_format(\Cart::getTotal(),0,".",".") }}</span></b></h1>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-10 text-right">
                                <div class="form group input-group">
                                    <br>
                                    <form action="{{ route('cart.clear') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-warning text-white"><i class="fa fa-sync-alt"></i> Reset</button>
                                    </form>
                                    <div class='px-1'></div>
                                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#prosesTransaksi"><i class="fa fa-paper-plane"></i> Proses Transaksi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="box box-widget">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-hover cart-table" id="cart-table">
                            <thead>
                                <tr>
                                    <th width="50px">No</th>
                                    <th>Kode Produk</th>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th width="10%">Diskon Item</th>
                                    <th>Sub Total</th>
                                    <th width="100px">Aksi</th>
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

<!-- Modal Proses Transaksi -->
<div class="modal fade" id="prosesTransaksi" tabindex="-1" role="dialog" aria-labelledby="prosesTransaksiTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prosesTransaksiTitle"><b>Proses Transaksi</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="{{route('transaction.process')}}" method="POST">
                    @csrf

                    <!-- <div class="form-group">
                        <label>Jumlah Uang</label>
                        <input placeholder="Jumlah Uang" type="number" class="form-control" name="jumlah_uang" onkeyup="kembalian()" required>
                    </div> -->

                    <!-- <div class="form-group">
                        <b>Total Bayar:</b> <span class="total_bayar"></span>
                    </div> -->

                    <div class="form-group">
                        <label for="user">Kasir <a class="text-danger">*</a></label>
                        <input id="user" value="{{ $kasir->name }}" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Customer <a class="text-danger">*</a></label>
                        <select id="customer" name="customer" class="form-control">
                            <!-- <option value="3">Umum</option> -->
                            @foreach ($customer as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea id="note" name="note" rows="2" class="form-control" placeholder="Optional"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Uang <a class="text-danger">*</a></label>
                        <input placeholder="Jumlah Uang" type="number" class="form-control cash" id="cash" name="cash" min="0" onkeyup="change()" required>
                    </div>

                    <!-- <div class="form-group">
                        <input type="text" id="change_views" class="form-control change" class="form-control" readonly>
                        <input type="hidden" id="change" class="change">
                    </div> -->

                    <div class="form-group">
                        <b style="font-size: 20pt">Total Bayar: <span id="grand_total_view" class="grand_total_view" style="font-size: 30pt">{{ number_format(\Cart::getTotal(),0,".",".") }}</span></b>
                        <input type="hidden" id="grand_total" name="grand_total" class="grand_total" value="{{ \Cart::getTotal() }}">
                    </div>

                    <div class="form-group">
                        <b style="font-size: 20pt">Kembalian: <span class="change" id="change" name="change" style="font-size: 30pt"></span></b>
                        <input type="hidden" id="changes" name="changes" class="change">
                    </div><br>

                    <div class="float-right">
                        <button type="submit" class="btn btn-success" value="Proses">Proses</button>
                        <button class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>

                    <!-- <button id="add" class="btn btn-success" type="submit" onclick="bayar()">Proses</button>
                    <button id="cetak" class="btn btn-success" type="submit" onclick="bayarCetak()">Proses Dan Cetak</button> -->
                    <!-- <button class="btn btn-danger" data-dismiss="modal">Batal</button> -->
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<script src="{{asset('js/cart.js')}}"></script>

<script>
    $(function() {
        $('#cart-table input[type=search]').focus();
    });

    $(document).keydown(function(event) {
        if (event.altKey && event.which === 65) {
            $("#pilihProduk").modal('show');;
            e.preventDefault();
        }
    });
</script>

<script src="{{asset('js/transaction.js')}}"></script>

@endpush