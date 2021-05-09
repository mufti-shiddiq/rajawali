@extends("adminlte::page")

@section("title") Input Kas Keluar @endsection

@section('content_header')
<h1> Input Kas Keluar</h1>
@stop

@push('css')
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
                <h3 class="card-title">Input Kas Keluar</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-sm p-3" enctype="multipart/form-data" action="{{route('wallets.store_cash_out')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="col">

                            <!-- <input type="hidden" name="transaction[]" id="cash_in" value="cash_in"> -->
                            <input type="hidden" name="transaction" id="Kas-Keluar" value="Kas-Keluar">

                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Tanggal/Waktu</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="text" id="datetime" name="datetime" class="form-control datetimepicker-input" data-target="#datetime" />
                                    <div class="input-group-append" data-target="#datetime" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cash_in">Nominal</label>
                                <input class="form-control" type="number" name="cash_out" id="cash_out" />
                            </div>

                            <div class="form-group">
                                <label for="note">Catatan</label>
                                <textarea class="form-control" name="note" id="note" rows="3"></textarea>
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
                        <a href="{{route('wallets.index')}}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="my-5"></div>
    </div>
    <!-- /.card -->
</div>
@endsection

@push('js')
<script type="text/javascript">
    //Date and time picker
    $(function() {
        $('#datetime').datetimepicker({
            format: 'DD-MM-YYYY HH:mm',
            icons: {
                time: 'far fa-clock'
            },
            locale: 'id',
            // inline: true,
            sideBySide: true,
            use24hours: true
        });


    });
</script>

@endpush