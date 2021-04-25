@extends("adminlte::page")

@section("title") Input Transaksi Kas Toko @endsection

@section('content_header')
<h1> Input Transaksi Kas</h1>
@stop

@push('css')
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
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
                <h3 class="card-title">Input Transaksi Kas</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-sm p-3" enctype="multipart/form-data" action="{{route('wallets.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="col">

                            <div class="form-group">
                                <label class="pr-3">Transaksi:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input nominal_in" type="radio" name="transaction[]" id="cash_in" value="cash_in">
                                    <label class="form-check-label" for="inlineRadio1">Kas Masuk</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input nominal_out" type="radio" name="transaction[]" id="cash_out" value="cash_out">
                                    <label class="form-check-label" for="inlineRadio2">Kas Keluar</label>
                                </div>
                            </div>

                            <!-- Date and time -->
                            <div class="form-group">
                            <label>Tanggal/Waktu</label>
                                <div class="input-group date" id="datetime" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetime"/>
                                    <div class="input-group-append" data-target="#datetime" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input  class="form-control" type="number" name="nominal" id="nominal" />
                            </div>

                            <div class="form-group">
                                <label for="address">Catatan</label>
                                <textarea  class="form-control" name="note" id="note" rows="3"></textarea>
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
                    <a href="{{route('wallets.index')}}" class="btn btn-danger">Batal</a>
                </div>
                </div>
            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->

@endsection

@push('js')

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>

<script type="text/javascript">

//Date and time picker
$(function () {
    $('#datetime').datetimepicker({
        format: 'DD-MM-YYYY HH:mm',
        icons: { time: 'far fa-clock' }, 
        locale: 'id',
        // inline: true,
        sideBySide: true,
        use24hours: true 
    });


});

$(document).ready(function(){
  $("#cash_in").click(function(){
    $(".nominal").attr("href", "https://www.w3schools.com/jquery/");
  });
});



</script>

@endpush