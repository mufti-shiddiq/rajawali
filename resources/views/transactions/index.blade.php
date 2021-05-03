@extends("adminlte::page")

@section("title") Transaksi @endsection

@push('css')
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('classes_body') sidebar-collapse @endsection

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Transaksi</h1>
    </div>
    <!-- <div class="col-md-6 text-right">
        <a href="{{route('suppliers.create')}}" class="btn btn-primary">Tambah Supplier Baru</a>
    </div> -->
</div>
@stop

@section("content")

<div class="card">
    <div class="card-header">
        <div class="row">

            <div class="col-lg-4">
                <div class="box box-widget">
                    <div class="box-body">
                        <table width="100%">
                            <!-- <tr>
                                <td style="vertical-align: top;">
                                    <label for="date">Tanggal / Waktu</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="datetime" id="date" value="{{-- $waktu --}}" class="form-control"
                                            readonly>
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <td style="vertical-align:top; width:30%">
                                    <label for="user">Kasir</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input id="user" value="{{ $kasir->name }}" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top">
                                    <label for="customer">Customer</label>
                                </td>
                                <td>
                                    <div>
                                        <select id="customer" class="form-control">
                                            <option value="">Umum</option>
                                            @foreach ($customer as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 pl-5 pr-1">
                <div class="box box-widget">
                    <div class="box-body">
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <table width="100%">
                                <tr>
                                    <td style="vertical-align: top;  width:20%">
                                        <label for="code">Produk</label>
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
                                            <input type="hidden" id="unit" name="unit">
                                            <input type="hidden" id="price" name="price">

                                            <input type="text" id="name" name="name" class="form-control" readonly>

                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#pilihProduk">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:top;">
                                        <label>Diskon Item</label>
                                    </td>
                                    <td>
                                        <input type="number" id="discount_item" name="discount_item" min="0" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:top;">
                                        <label>Qty</label>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control">
                                            <div class="px-5"></div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-cart-plus"></i> Tambah
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                                <tr class="text-right">
                                    <td></td>

                                </tr>
                            </table>

                        </form>


                        <!-- <table width="100%">
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="code">Produk</label>
                                </td>
                                <td>
                                    <div class="form-group input-group">
                                        <!-- <input type="hidden" id="item_id"> ->
                                        <input id="price" type="text" >
                                        <!-- <input type="hidden" id="stock"> ->
                                        <input id="product_name" type="text">
                                        <input id="code" type="text" class="form-control" autofocus>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal"
                                                data-target="#pilihProduk">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align:top;">
                                    <label>Qty</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input id="qty" type="number" value="1" min="1" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-right">
                                <td></td>
                                <td>
                                    <button type="button" onclick="add()" id="add_cart" class="btn btn-primary">
                                        <i class="fa fa-cart-plus"></i> Tambah
                                    </button>
                                </td>
                            </tr>
                        </table> -->
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="box box-widget">
                    <div class="box-body">
                        <div align="right">
                            <h4>Invoice <b><span id="invoice"></span></b></h4>
                            <h1><b><span class="grand_total" id="grand_total2" style="font-size: 50pt;">{{ number_format(\Cart::getTotal(),0,".",".") }}</span></b></h1>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-lg-12">
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
                                    <th>Total</th>
                                    <th width="100px"></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-4">

            <div class="col-lg-3 px-3">
                <div class="box box-widget">
                    <div class="box-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align: top; width:30%">
                                    <label for="sub_total">Sub Total</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="sub_total_view" class="form-control sub_total" value="{{ number_format(\Cart::getSubTotal(),0,".",".") }}" class="form-control" readonly>
                                        <input type="hidden" id="sub_total" class="sub_total" value="{{ \Cart::getSubTotal() }}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="discount_total">Diskon</label>
                                </td>
                                <td>
                                    <div class="form-group input-group">
                                        <input type="number" id="discount_total" class="form-control discount_total" min="0" class="form-control">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="grand_total">Grand Total</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <!-- <input type="number" id="grand_total" class="grand_total" value="" class="form-control" readonly> -->
                                        <input type="text" id="grand_total_view" class="form-control grand_total_view" value="{{ number_format(\Cart::getTotal(),0,".",".") }}" class="form-control" readonly>
                                        <input type="hidden" id="grand_total" class="grand_total" value="{{ \Cart::getTotal() }}">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 px-3">
                <div class="box box-widget">
                    <div class="box-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align: top; width:30%">
                                    <label for="cash">Tunai</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="cash" class="form-control cash" value="0" min="0" onkeyup="change()" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="change">Kembalian</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="change_view" class="form-control change" class="form-control" readonly>
                                        <input type="hidden" id="change" class="change">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 px-3">
                <div class="box box-widget">
                    <div class="box-body">
                        <table width="100%">
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="note">Catatan</label>
                                </td>
                                <td>
                                    <div>
                                        <textarea id="note" rows="3" class="form-control"></textarea>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form group input-group">
                    <br>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button class="btn btn-warning text-white"><i class="fa fa-sync-alt"></i> Reset</button>
                    </form>
                    <div class='px-1'></div>
                    <form action="{{ route('transaction.process') }}" method="POST">
                        @csrf
                        <button class="btn btn-success btn-lg"><i class="fa fa-paper-plane"></i> Proses Transaksi</button>
                    </form>
                    <!-- <button id="cancel_payment" class="btn btn-warning text-white">
                        <i class="fa fa-sync-alt"></i> Reset
                    </button> -->
                    <!-- <br><br> -->
                    <!-- <button id="process_payment" class="btn btn-lg btn-success">
                        <i class="fa fa-paper-plane"></i> Proses Transaksi
                    </button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
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
<script>
    var BASE_URL = "{{url('/')}}"
</script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
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

<!-- <script type="text/javascript">
$('#updateitem').on('show.bs.modal', function(e) {
    $(this).find('.modal-body').text(e.relatedTarget.id);
});

function change() {
    let grand_total = $("#grand_total").val(),
        cash = $("#cash").val(),
        discount = $("#discount").val();
    $(".change").val(cash - grand_total - discount);
}

function total() {
    let sub_total = $("#sub_total").val(),
        discount = $("#discount").val();
    $(".grand_total").val(sub_total - discount);
}


</script> -->

<!-- <script type="text/javascript">

function change() {
    let grand_total = $("#grand_total").val(),
        cash = $("#cash").val();
    $(".change").val(cash - grand_total);
}

function invoice(jumlah) {
    let hasil = "",
        char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        total = char.length;
    for (var r = 0; r < jumlah; r++) hasil += char.charAt(Math.floor(Math.random() * total));
    return hasil
}
$("#invoice").html(invoice(10));

</script> -->

@endpush