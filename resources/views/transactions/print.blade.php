<html>

<head>
    <title>Print Invoice</title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;'>
    <center>
        <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                <span style='font-size:15pt'><b>Rajawali Besi</b></span></br>
                Bakalan RT.02 RW.01 Ceper, Kec. Ceper<br>
                Kab. Klaten, Jawa Tengah, Indonesia 57465</br>
                Telp : 081285555515
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                <b><span style='font-size:12pt'>Invoice {{$transaction->invoice}}</span></b></br>
                Tanggal : {{$transaction->datetime}}</br>
                Kasir : {{$transaction->user->name}}</br>
                Customer : {{$transaction->customer->name}} {{$transaction->customer->company}} <br>
                No Telp : {{$transaction->customer->phone}} <br><br>
            </td>
        </table>
        <!-- <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                <br>

            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                Kasir : Kasir</br>
                Customer : Umum <br>
                No Telp : -
            </td>
        </table> -->
        <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>

            <tr align='center'>
                <td width='10%'>Kode Barang</td>
                <td width='20%'>Nama Barang</td>
                <td width='4%'>Qty</td>
                <td width='4%'>Satuan</td>
                <td width='13%'>Harga Satuan</td>
                <td width='7%'>Diskon Item</td>
                <td width='13%'>Sub Total</td>
            </tr>
            @foreach($trx_detail as $item)
            <tr>
                <td>{{$item->code}}</td>

                <td>{{$item->product}}</td>

                <td style='text-align:center'>{{$item->quantity}}</td>

                <td style='text-align:center'>{{$item->unit}}</td>

                <td style='text-align:right'>{{ number_format($item->price,0,".",".") }} </td>

                <td style='text-align:right'>{{ number_format($item->discount_item,0,".",".") }} </td>

                <td style='text-align:right'>{{ number_format($item->sub_total,0,".",".") }} </td>
            </tr>
            @endforeach

        </table>
        <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='0'>
            <tr align='center'>
                <td width='10%'></td>
                <td width='20%'></td>
                <td width='4%'></td>
                <td width='4%'></td>
                <td width='13%'></td>
                <td width='7%'></td>
                <td width='13%'></td>
            <tr>
            <tr>
                <td colspan="3">Catatan: {{$transaction->note}}</td>
                <td colspan='3'>
                    <div style='text-align:right'>Grand Total : </div>
                </td>
                <td style='text-align:right'>{{ number_format($transaction->grand_total,0,".",".") }}</td>
            </tr>
            <tr>
                <td colspan='6'>
                    <div style='text-align:right'>Tunai : </div>
                </td>
                <td style='text-align:right'>{{ number_format($transaction->cash,0,".",".") }}</td>
            </tr>
            <tr>
                <td colspan='6'>
                    <div style='text-align:right'>Kembalian : </div>
                </td>
                <td style='text-align:right'>{{ number_format($transaction->change,0,".",".") }}</td>
            </tr>
        </table>

        <table style='width:650; font-size:7pt;' cellspacing='2'>
            <tr>
                <br>
                <td align='center'>Penerima</br></br></br><br><u>(................)</u></td>
                <!-- <td style='border:1px solid black; padding:5px; text-align:left; width:30%'></td> -->
                <td align='center'>Hormat kami</br></br></br><br><u>(................)</u></td>
            </tr>
        </table>
    </center>
    <script>
        window.print()
    </script>
</body>

</html>