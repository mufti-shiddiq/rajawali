@extends("adminlte::page")

@section("title") Transaksi @endsection

@push('css')
@endpush

@section('classes_body') sidebar-collapse @endsection

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Transaksi</h1>
    </div>
</div>
@stop

@section("content")

<div class="row">
    <div class="col-md-5 mx-auto">

        <!-- general form elements -->
        <div class="card card-success shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Transaksi Sukses!</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-sm p-3" enctype="multipart/form-data" action="{{route('categories.store')}}" method="POST">
                @csrf
                <div class="card-body text-center">

                    <div class="icon">
                        <i class="far fa-7x fa-check-circle text-success"></i>
                    </div><br>

                    <h3>Transaksi <b>{{$last_inv}}</b> Sukses!</h3>

                    <!-- <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input class="form-control" placeholder="Nama Kategori" type="text" name="name" id="name" />
                    </div> -->

                </div>
                <!-- /.card-body -->

                <div class="card-footer  text-center">
                    <!-- <input class="btn btn-primary" type="submit" value="Save" /> -->
                    <!-- <button type="submit" class="btn btn-primary" value="Print"><i class="fa fa-print"></i> Print</button> -->
                    <a class="btn btn-primary" href="{{route('transaction.print', [$last_id])}}"><i class="fa fa-print"></i> Print</a>
                    <a href="{{route('transaction.index')}}" class="btn btn-danger">Kembali</a>

                </div>
            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->

    @endsection

    @push('js')
    @endpush