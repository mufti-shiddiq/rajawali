@extends("adminlte::page")

@section("title") Laporan Stok Masuk @endsection

@push('css')
@endpush

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Laporan Stok Masuk</h1>
    </div>
    <!-- <div class="col-md-6 text-right">
        <a href="{{route('stock_in.create')}}" class="btn btn-primary">Input Stok Masuk</a>
    </div> -->
</div>
@stop

@section("content")
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped table-hover bg-white data-table" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Quantity</th>
                    <th>Keterangan</th>
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
            order: [1, "asc"],

            ajax: "{{ route('stock_in.index') }}",
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
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'name',
                    name: 'name'
                },

                {
                    data: 'quantity',
                    name: 'quantity'
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