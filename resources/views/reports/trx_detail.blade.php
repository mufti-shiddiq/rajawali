@extends("adminlte::page")

@section("title") Detail Transaksi @endsection

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Detail Transaksi</h1>
    </div>
    <div class="col-md-6 text-right">
        <a class="btn btn-primary" href="{{route('transaction.print', [$id])}}" target="_blank"><i class="fa fa-print"></i> Print</a>
        <!-- <a href="{{route('reports.transaction')}}" class="btn btn-danger">Kembali</a> -->
        <input class="btn btn-danger" type="button" value="Kembali" onclick="history.back()">
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
                {{$transaction->datetime}}
                <br>

                <b>Kasir:</b> <br />
                {{$transaction->user->name}}
                <br>

                <b>Pelanggan:</b> <br />
                {{$transaction->customer->name}}
                <br>

                <b>Nilai Transaksi:</b> <br />
                {{ number_format($transaction->grand_total,0,".",".") }}
                <br>

                <b>Total Bayar:</b> <br />
                {{ number_format($transaction->cash,0,".",".") }}
                <br>

                <b>Kembalian:</b> <br />
                {{ number_format($transaction->change,0,".",".") }}
                <br>

                <b>Modal:</b> <br />
                {{ number_format($transaction->capital,0,".",".") }}
                <br>

                <b>Profit:</b> <br />
                {{ number_format($transaction->profit,0,".",".") }}
                <br>

                <b>Catatan:</b> <br />
                {{$transaction->note}}
                <br>

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
                            <th>Profit</th>
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

                            <td>{{ number_format($item->price,0,".",".") }}</td>

                            <td>{{ number_format($item->discount_item,0,".",".") }}</td>

                            <td>{{ number_format($item->sub_total,0,".",".") }}</td>

                            <td>{{ number_format($item->profit,0,".",".") }}</td>

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