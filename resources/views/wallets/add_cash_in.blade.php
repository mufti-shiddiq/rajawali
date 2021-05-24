@extends("adminlte::page")

@section("title") Input Kas Masuk @endsection

@section('content_header')
<h1> Input Kas Masuk</h1>
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
                <h3 class="card-title">Input Kas Masuk</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="bg-white shadow-sm p-3" enctype="multipart/form-data" action="{{route('wallets.store_cash_in')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="col">

                            <!-- <input type="hidden" name="transaction[]" id="cash_in" value="cash_in"> -->
                            <input type="hidden" name="transaction" id="Kas-Masuk" value="Kas-Masuk">

                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Tanggal/Waktu <a class="text-danger">*</a></label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input value="{{old('datetime')}}" type="text" id="datetime" name="datetime" class="form-control datetimepicker-input {{$errors->first('datetime') ? "is-invalid": ""}}" data-target="#datetime" />
                                    <div class="input-group-append" data-target="#datetime" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    {{$errors->first('datetime')}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cash_in">Nominal <a class="text-danger">*</a></label>
                                <input value="{{old('cash_in')}}" class="form-control {{$errors->first('cash_in') ? "is-invalid": ""}}" type="number" name="cash_in" id="cash_in" />
                                <div class="invalid-feedback">
                                    {{$errors->first('cash_in')}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">Catatan</label>
                                <textarea class="form-control {{$errors->first('note') ? "is-invalid": ""}}" name="note" id="note" rows="3">{{old('note')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('note')}}
                                </div>
                            </div>

                            <b class="text-danger">* Wajib diisi</b>

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