@extends("adminlte::page")

@section("title") Laporan Transaksi Bulanan @endsection

@push('css')
@endpush

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Laporan Transaksi Bulanan</h1>
    </div>
    <!-- <div class="col-md-6 text-right">
        <a href="{{route('products.create')}}" class="btn btn-primary">Tambah Produk Baru</a>
    </div> -->
</div>
@stop

@section("content")

<div class="row">
    <div class="col-md-3">

        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$countTrx}}</h3>
                <p>Transaksi Bulan ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <!-- <a class="small-box-footer">
                <i class="fas fa-info-circle"></i>
            </a> -->
        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{"Rp " . number_format($totalValueTrx,0,".",".")}}</h3>
                <p>Nilai Transaksi Bulan ini</p>
            </div>
            <div class="icon">
                <i class="fa fa-money-bill"></i>
            </div>
            <!-- <a class="small-box-footer">
                <i class="fas fa-info-circle"></i>
            </a> -->
        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-warning">
            <div class="inner">
                <h3> {{ $countTotalProduct }} </h3>
                <p>Produk Terjual Bulan ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <!-- <a class="small-box-footer">
                <i class="fas fa-info-circle"></i>
            </a> -->
        </div>

    </div>
    <div class="col-md-3">

        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{"Rp " . number_format($profit,0,".",".")}}</h3>
                <p>Profit Bulan ini</p>
            </div>
            <div class="icon">
                <i class="fa fa-chart-bar"></i>
            </div>
            <!-- <a class="small-box-footer">
                <i class="fas fa-info-circle"></i>
            </a> -->
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
<script type="text/javascript">
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            order: [1, "desc"],

            ajax: "{{ route('reports.weekly') }}",
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