@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<!-- <p>Selamat Datang di Dashboard</p> -->
<div class="row">
    <div class="col-md-3">

        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$total_trx_today}}</h3>
                <p>Transaksi Hari ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="{{route('reports.daily')}}" class="small-box-footer">
                Info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{"Rp " . number_format($total_value_trx_today,0,".",".")}}</h3>
                <p>Nilai Transaksi Hari ini</p>
            </div>
            <div class="icon">
                <i class="fa fa-money-bill"></i>
            </div>
            <a href="{{route('reports.daily')}}" class="small-box-footer">
                Info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{"Rp " . number_format($profit_today,0,".",".")}}</h3>
                <p>Profit Hari ini</p>
            </div>
            <div class="icon">
                <i class="fa fa-chart-bar"></i>
            </div>
            <a href="{{route('reports.daily')}}" class="small-box-footer">
                Info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>
    <div class="col-md-3">

        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{"Rp " . number_format($cash_balance,0,".",".")}}</h3>
                <p>Saldo Kas Toko</p>
            </div>
            <div class="icon">
                <i class="fa fa-wallet"></i>
            </div>
            <a href="{{route('wallets.index')}}" class="small-box-footer">
                Info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <!-- AREA CHART -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Transaksi Minggu ini</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-6">
        <!-- BAR CHART -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Nilai Transaksi dan Profit Minggu ini</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- <div class="row">
    <div class="col-6">
        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Pie Chart</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="produk-terlaris"></canvas>
                </div>
            </div>
 
        </div>
 
    </div>
</div> -->

<!-- <div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Penjualan Bulan Ini</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="bulanIni" style="min-height: 250px; height: 450px; max-height: 450px; max-width: 100%"></canvas>
                </div>
            </div>
        </div>
    </div>
</div> -->

@stop

@section('footer')
true
@endsection

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
<script>
    console.log('Hi!');
</script>

<script>
    var BASE_URL = "{{url('/')}}"
</script>

<script>
    //-------------
    //- LINE CHART -
    //-------------
    var lineChartCanvas = $('#barChart').get(0).getContext('2d')

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
    var barChartCanvas = $('#lineChart').get(0).getContext('2d')

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

<script src="{{asset('js/dashboard.js')}}"></script>



<!-- <script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 4],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script> -->

@stop