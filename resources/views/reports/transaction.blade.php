@extends("adminlte::page")

@section("title") Laporan Semua Transaksi @endsection

@push('css')
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/> -->
<!-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Laporan Semua Transaksi</h1>
    </div>
    <!-- <div class="col-md-6 text-right">
        <a href="{{route('products.create')}}" class="btn btn-primary">Tambah Produk Baru</a>
    </div> -->
</div>
@stop

@section("content")
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped table-hover bg-white transaction-table" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Invoice</th>
                    <th>Pelanggan</th>
                    <th>Nilai Transaksi</th>
                    <th>Catatan</th>
                    <th>Kasir</th>
                    <th></th>
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

<script type="text/javascript">
    $(function() {
        var table = $('.transaction-table').DataTable({
            processing: true,
            serverSide: true,
            order: [1, "desc"],

            ajax: "{{ route('reports.transaction') }}",
            columns: [

                {
                    "data": null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'datetime',
                    name: 'datetime'
                },
                {
                    data: 'invoice',
                    name: 'invoice'
                },
                {
                    data: 'customer',
                    name: 'customer'
                },
                {
                    data: 'grand_total',
                    name: 'grand_total',
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    data: 'note',
                    name: 'note'
                },
                {
                    data: 'user',
                    name: 'user.name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>
@endpush