@extends("adminlte::page")

@section("title") Kas Toko @endsection

@push('css')
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/> -->
<!-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Kas Toko</h1>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{route('products.create')}}" class="btn btn-primary">Transaksi Kas Baru</a>
    </div>
</div>
@stop

@section("content")
<div class="row">
    <div class="col-md-4">

        <div class="small-box bg-info">
             <div class="inner">
                <h3>0</h3>
                <p>Saldo Kas</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>

    <div class="col-md-4">

        <div class="small-box bg-success">
             <div class="inner">
                <h3>10</h3>
                <p>Total Kas Masuk</p>
            </div>
            <div class="icon">
                <i class="fas fa-plus"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    
    </div>

    <div class="col-md-4">

        <div class="small-box bg-danger">
             <div class="inner">
                <h3>30</h3>
                <p>Total Kas Keluar</p>
            </div>
            <div class="icon">
                <i class="fas fa-minus"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>

</div>


<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped table-hover bg-white data-table" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Transaksi</th>
                    <th>Nominal</th>
                    <th>Pengguna</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
        
            </tbody>
            </table>
    </div>
</div>
<div class="py-3"></div>
    
@endsection

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<!-- <script type="text/javascript">

  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        order: [ 3, "asc" ],
                
        ajax: "{{ route('products.index') }}",
        columns: [

            { "data": null,"sortable": false, 
                render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                            }  
            },

            {data: 'id', name: 'id', visible: false, orderable: false, searchable: false},
            {data: 'code', name: 'code'},
            {data: 'product_name', name: 'product_name'},
            {data: 'category', name: 'category.name'},
            {data: 'unit', name: 'unit.code'},
            {data: 'stock', name: 'stock'},
            {data: 'sold', name: 'sold'},
            {data: 'buy_price', name: 'buy_price', render: $.fn.dataTable.render.number('.', '.', 0, '')},
            {data: 'sell_price', name: 'sell_price', render: $.fn.dataTable.render.number('.', '.', 0, '')},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });

</script> -->
@endpush
