@extends("adminlte::page")

@section("title") Detail Transaksi @endsection

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Detail Transaksi</h1>
    </div>
    <div class="col-md-6 text-right">
        <a href="#" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
        <a href="{{route('reports.transaction')}}" class="btn btn-danger">Kembali</a>
    </div>
</div>
@stop

@push('css')
@endpush

@section("content")
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h2><b>{{$transaction->invoice}}</b></h2>

                <b>Tanggal:</b> <br />
                {{$transaction->created_at}}
                <br>

                <b>Kasir:</b> <br />
                {{$transaction->user->name}}
                <br>

                <b>Pelanggan:</b> <br />
                {{$transaction->customer->name}}
                <br>

                <b>Nilai Transaksi:</b> <br />
                {{$transaction->grand_total}}
                <br>

                <b>Total Bayar:</b> <br />
                {{$transaction->cash}}
                <br>

                <b>Kembalian:</b> <br />
                {{$transaction->change}}
                <br>

                <b>Catatan:</b> <br />
                {{$transaction->note}}
                <br>

                <!-- <b class="text-danger">TODO: Info Role dan Status user belum bisa muncul</b> -->

            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-stripped table-hover bg-white trx_detail-table" id="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Harga Satuan</th>
                            <th>Diskon Item</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trx_detail as $item)
                        <tr>
                            <th class="leading-6 text-center whitespace-nowrap">{{$loop->iteration}}.</th>

                            <td>{{$item->code}}</td>

                            <td>{{$item->product}}</td>

                            <td>{{$item->quantity}}</td>

                            <td>{{$item->unit}}</td>

                            <td>{{$item->price}}</td>

                            <td>{{$item->discount_item}}</td>

                            <td>{{$item->sub_total}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush