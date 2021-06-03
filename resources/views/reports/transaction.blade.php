@extends("adminlte::page")

@section("title") Laporan Semua Transaksi @endsection

@push('css')
@endpush

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Laporan Semua Transaksi</h1>
    </div>
    <!-- <div class="col-md-6 text-right">
        <a class="btn btn-primary"><i class="fa fa-print"></i> Print Chart</a>
    </div> -->
</div>
@stop

@section("content")
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped table-hover bg-white transaction-table" id="table">
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
<div class="py-3"></div>

@endsection

@push('js')
<script type="text/javascript">
    $(function() {


        var table = $('.transaction-table').DataTable({

            processing: true,
            serverSide: true,
            order: [2, "desc"],
            dom: 'Bfrtip',
            lengthChange: true,

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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                'colvis'
            ],

            ajax: "{{ route('reports.transaction') }}",
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

        table.buttons().container()
            .appendTo('#datatables_wrapper .col-md-6:eq(0)');

    });
</script>
@endpush