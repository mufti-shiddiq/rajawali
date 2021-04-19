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
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="date">Tanggal / Waktu</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="datetime" id="date" value="{{ $waktu }}" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
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
                        <table width="100%">
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="product_name">Produk</label>
                                </td>
                                <td>
                                    <div class="form-group input-group">
                                        <input type="hidden" id="item_id">
                                        <input type="hidden" id="price">
                                        <input type="hidden" id="stock">
                                        <input type="text" id="product_name" class="form-control" autofocus>
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
                                    <label for="user">Qty</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="qty" value="1" min="1" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-right">
                                <td></td>
                                <td>
                                    <button type="button" id="add_cart" class="btn btn-primary">
                                        <i class="fa fa-cart-plus"></i> Tambah
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="box box-widget">
                    <div class="box-body">
                        <div align="right">
                            <h4>Invoice <b><span id="invoice">RJ160420210001</span></b></h4>
                            <h1><b><span id="grand_total2" style="font-size: 50pt;">50000</span></b></h1>
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
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th width="10%">Diskon Item</th>
                                    <th width="15%">Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="cart_table">
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada item</td>
                                </tr>
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
                                        <input type="number" id="sub_total" value="" class="form-control" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="discount">Diskon</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="discount" value="0" min="0" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="grand_total">Total</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="grand_total" value="" class="form-control" readonly>
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
                                        <input type="number" id="cash" value="0" min="0" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">
                                    <label for="change">Kembalian</label>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" id="change" class="form-control" readonly>
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
                <div>
                    <br>
                    <button id="cancel_payment" class="btn btn-warning text-white">
                        <i class="fa fa-sync-alt"></i>  Batal
                    </button>
                    <!-- <br><br> -->
                    <button id="process_payment" class="btn btn-lg btn-success">
                        <i class="fa fa-paper-plane"></i> Proses Transaksi
                    </button>
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
                    <table class="table table-bordered table-stripped table-hover bg-white data-table" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">

  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        order: [ 2, "asc" ],
                
        ajax: "{{ route('products.index') }}",
        columns: [

            { "data": null,"sortable": false, 
                render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                            }  
            },

            {data: 'code', name: 'code'},
            {data: 'product_name', name: 'product_name'},
            {data: 'category', name: 'category.name'},
            {data: 'unit', name: 'unit.code'},
            {data: 'stock', name: 'stock'},
            {data: 'sell_price', name: 'sell_price'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
        ]
    });
  });

</script>
@endpush