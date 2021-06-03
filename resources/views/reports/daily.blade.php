@extends("adminlte::page")

@section("title") Laporan Transaksi Harian di Bulan {{$bulan}}@endsection

@push('css')
<link rel="stylesheet" href="{{asset('css/printchart.css')}}" />
@endpush

@section('content_header')

@stop

@section("content")
<div class="row">
    <div class="col-md-10">
        <h2>Laporan Transaksi Harian di Bulan {{$bulan}}</h2>
        <br>
    </div>
    <div class="col-md-2 text-right noprint">
        <a class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print Chart</a>
    </div>
</div>

<div class="row">
    <div class="col-md-3">

        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$countTrx}}</h3>
                <p>Transaksi Hari ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a class="small-box-footer">
                Kemarin {{$countTrxYtd}}
                <!-- <i class="fas fa-info-circle"></i> -->
            </a>
        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{"Rp " . number_format($totalValueTrx,0,".",".")}}</h3>
                <p>Nilai Transaksi Hari ini</p>
            </div>
            <div class="icon">
                <i class="fa fa-money-bill"></i>
            </div>
            <a class="small-box-footer">
                Kemarin {{"Rp " . number_format($totalValueTrxYtd,0,".",".")}}
                <!-- <i class="fas fa-info-circle"></i> -->
            </a>
        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-warning">
            <div class="inner">
                <h3> {{ $countTotalProduct }} </h3>
                <p>Produk Terjual Hari ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <a class="small-box-footer">
                Kemarin {{ $countTotalProductYtd }}
                <!-- <i class="fas fa-info-circle"></i> -->
            </a>
        </div>

    </div>
    <div class="col-md-3">

        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{"Rp " . number_format($profit,0,".",".")}}</h3>
                <p>Profit Hari ini</p>
            </div>
            <div class="icon">
                <i class="fa fa-chart-bar"></i>
            </div>
            <a class="small-box-footer">
                Kemarin {{"Rp " . number_format($profitYtd,0,".",".")}}
                <!-- <i class="fas fa-info-circle"></i> -->
            </a>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-primary shadow ">
            <div class="card-header">
                <h3 class="card-title">Transaksi Bulan ini</h3>
            </div>
            <!-- <div class="card-body">
                <div class="chart">
                    <canvas id="cartBulanIni" style="min-height: 250px; height: 300px; max-height: 450px; max-width: 100%"></canvas>
                </div>
            </div> -->
            <div class="card-body">
                <div class="chart">
                    <canvas id="cartTrxBulanIni" style="min-height: 250px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-primary shadow ">
            <div class="card-header">
                <h3 class="card-title">Nilai Transaksi dan Profit Bulan ini</h3>
            </div>
            <!-- <div class="card-body">
                <div class="chart">
                    <canvas id="cartBulanIni" style="min-height: 250px; height: 300px; max-height: 450px; max-width: 100%"></canvas>
                </div>
            </div> -->
            <div class="card-body">
                <div class="chart">
                    <canvas id="cartProfitBulanIni" style="min-height: 250px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row noprint">
    <div class="col-md-12">
        <div class="card card-primary shadow ">
            <div class="card-header">
                <h3 class="card-title">Laporan Transaksi Bulan ini</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-stripped table-hover bg-white data-table" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Transaksi</th>
                            <th>Produk Terjual</th>
                            <th>Nilai Transaksi</th>
                            <th>Modal</th>
                            <th>Profit</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="row noprint">
    <div class="col-md-12">
        <div class="card card-primary shadow ">
            <div class="card-header">
                <h3 class="card-title">Transaksi Hari ini</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-stripped table-hover bg-white trx-table" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Invoice</th>
                            <th>Pelanggan</th>
                            <th>Nilai Transaksi</th>
                            <th>Modal</th>
                            <th>Profit</th>
                            <th>Catatan</th>
                            <th>Kasir</th>
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

<div class="py-3"></div>

@endsection

@push('js')
<script>
    //-------------
    //- LINE CHART -
    //-------------
    var lineChartCanvas = $('#cartProfitBulanIni').get(0).getContext('2d')

    var cData = JSON.parse(`<?php echo $chart_data; ?>`);

    var lineChartData = {
        // labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni', 'Juli', 'Agst', 'Sep', 'Okt', 'Nov', 'Des'],
        labels: cData.profit_label,
        datasets: [{
                label: 'Nilai Transaksi',
                backgroundColor: 'rgba(210, 214, 222, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: cData.value_data
            },
            {
                label: 'Profit',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: cData.profit_data
                // data: [65, 59, 80, 81, 56, 55, 40]
            },
        ]
    }


    var lineChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }

    new Chart(lineChartCanvas, {
        type: 'bar',
        data: lineChartData,
        options: lineChartOptions
    })
</script>

<script>
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#cartTrxBulanIni').get(0).getContext('2d')

    var cData = JSON.parse(`<?php echo $chart_data; ?>`);

    var barChartData = {
        // labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni', 'Juli', 'Agst', 'Sep', 'Okt', 'Nov', 'Des'],
        labels: cData.trx_label,
        datasets: [{
            label: 'Transaksi',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: cData.trx_data
            // data: [65, 59, 80, 81, 56, 55, 40]
        }, ]
    }


    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }

    new Chart(barChartCanvas, {
        type: 'line',
        data: barChartData,
        options: barChartOptions
    })
</script>

<script type="text/javascript">
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            order: [1, "desc"],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6],
                        format: {
                            body: function(data, row, column, node) {
                                return column ?
                                    data.replace(/[.]/g, '') :
                                    data;
                            }
                        }
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                'colvis'
            ],

            ajax: "{{ route('reports.daily') }}",
            columns: [

                {
                    "data": null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'date',
                    name: 'date',
                },
                {
                    data: 'transaction',
                    name: 'transaction',
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    data: 'product',
                    name: 'product',
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    data: 'value',
                    name: 'value',
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    data: 'capital',
                    name: 'capital',
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    data: 'profit',
                    name: 'profit',
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
            ]
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        var table = $('.trx-table').DataTable({
            processing: true,
            serverSide: true,
            order: [2, "desc"],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                        format: {
                            body: function(data, row, column, node) {
                                return column ?
                                    data.replace(/[.]/g, '') :
                                    data;
                            }
                        }
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                'colvis'
            ],

            ajax: "{{ route('reports.daily2') }}",
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
                    data: 'capital',
                    name: 'capital',
                    render: $.fn.dataTable.render.number('.', '.', 0, '')
                },
                {
                    data: 'profit',
                    name: 'profit',
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