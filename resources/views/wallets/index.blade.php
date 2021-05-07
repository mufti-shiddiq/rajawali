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
    <!-- <div class="col-md-6 text-right">
        <a href="{{route('wallets.add_cash_in')}}" class="btn btn-primary">Input Kas Masuk</a>
        <a href="{{route('wallets.add_cash_out')}}" class="btn btn-info">Input Kas Keluar</a>
    </div> -->
</div>
@stop

@section("content")
<div class="row">
    <div class="col-md-4">

        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{"Rp " . number_format($balance,0,".",".")}}</h3>
                <p>Saldo Kas</p>
            </div>
            <div class="icon">
                <i class="fa fa-wallet"></i>
            </div>
            <a class="small-box-footer">
                <i class="fas fa-info-circle"></i>
            </a>
        </div>

    </div>

    <div class="col-md-4">

        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{"+ Rp " . number_format($last_ci_value,0,".",".")}}</h3>
                <p>{{$last_ci_note}} (Kas Masuk Terakhir)</p>
            </div>
            <div class="icon">
                <i class="fas fa-plus"></i>
            </div>
            <a href="{{route('wallets.add_cash_in')}}" class="small-box-footer">
                Input Kas Masuk <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>

    <div class="col-md-4">

        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{"- Rp " . number_format($last_co_value,0,".",".")}}</h3>
                <p>{{$last_co_note}} (Kas Keluar Terakhir)</p>
            </div>
            <div class="icon">
                <i class="fas fa-minus"></i>
            </div>
            <a href="{{route('wallets.add_cash_out')}}" class="small-box-footer">
                Input Kas Keluar <i class="fas fa-arrow-circle-right"></i>
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
                    <th>Nominal Kas Masuk</th>
                    <th>Nominal Kas Keluar</th>
                    <th>User</th>
                    <th>Catatan</th>
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
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            order: [1, "asc"],

            ajax: "{{ route('wallets.index') }}",
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
                    data: 'transaction',
                    name: 'transaction'
                },
                {
                    data: 'cash_in',
                    name: 'cash_in',
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    data: 'cash_out',
                    name: 'cash_out',
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    data: 'created_by',
                    name: 'created_by'
                },
                {
                    data: 'note',
                    name: 'note'
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