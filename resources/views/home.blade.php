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
                <h3>150</h3>
                <p>Transaksi</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-success">
             <div class="inner">
                <h3>100</h3>
                <p>Produk</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    
    </div>
    <div class="col-md-3">

        <div class="small-box bg-warning">
             <div class="inner">
                <h3>10</h3>
                <p>Pelanggan</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>
    <div class="col-md-3">

        <div class="small-box bg-danger">
             <div class="inner">
                <h3>5</h3>
                <p>Pengguna</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop
