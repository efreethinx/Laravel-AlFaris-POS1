<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktur - #{{ $orders->no_faktur }}</title>
    <style>
        @page{ margin: 0px; }

        body{
            padding: 30px;
            padding-top: 0px;
            padding-bottom: 0px;
            margin: 0px;
        }
        .page{
            max-width: 80em;
            margin: 0 auto;
        }
        table th,
        table td{
            text-align: left;
        }
        table.layout{
            width: 100%;
            border-collapse: collapse;
        }
        table.display{
            margin: 1em 0;
        }
        table.display th,
        table.display td{
            border: 1px solid #B3BFAA;
            padding: .5em 1em;
        }

        table.display th{ background: #D5E0CC; }
        table.display td{ background: #fff; }

        table.responsive-table{
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
        }

        .listcust {
            margin: 0;
            padding: 0;
            list-style: none;
            display:table;
            border-spacing: 10px;
            border-collapse: separate;
            list-style-type: none;
        }

        .customer {
            padding-left: 0px;            
        }
    </style>
</head>
<body style="font-size:20px">
    
    <table border="0px">
    <tr>
    <td width="440px">
    <div class="header">
        <table style="width: 100%; padding-top: 20px">
            <tr>
                <td style="font-weight: bold; font-size: 24px">{{ $info->nama_toko }}</td>
            </tr>    
            <tr>    
                <td>{{ $info->alamat_toko }}</td>
            </tr>    
            <tr>
                <td>Telepon : {{ $info->hp_toko }}</td>
            </tr>
        </table>
        
        <?php
            $retrieved = $orders->tanggal_faktur;
            $date = DateTime::createFromFormat('Y-m-d', $retrieved);
            $tgl = $date->format('d-m-Y');
        ?>
        
        <table style="width: 100%; padding-top: 20px">
            <tr>
                <td>No. Faktur</td>
                <td>:</td>
                <td>#{{ $orders->no_faktur }}</td>
            </tr>
            <tr>
                <td>Tanggal Faktur</td>
                <td>:</td>
                <td>{{ $tgl }}</td>
            </tr>    
        </table>
    </div>
    <td style="width: 320px; font-weight: bold; font-size: 24px">FAKTUR PENJUALAN</td>
    <td  style="width: 480px">
    <div class="customer">
        <table style="padding-top: 120px">
            <tr>
                <td>Pelanggan </td>
                <td> : </td>
                <td> {{ $orders->nama_kontak }}</td>
            </tr>
            <tr>
                <td>No Telp </td>
                <td> : </td>
                <td> {{ $orders->kontak }}</td>
            </tr>
            <tr>
                <td>Alamat </td>
                <td> : </td>
                <td> {{ $orders->alamat }}</td>
            </tr>
        </table>
    </div></td> 
    </tr>   
    </table>
    
    
    <div class="page">
    <hr>
        <table class="layout display responsive-table">
            <thead>
                <tr>
                    <th style="text-align: center; width: 10px">#</th>
                    <th>Produk</th>
                    <th width="100px" style="text-align:right">Harga</th>
                    <th width="50px" style="text-align:centre">Qty</th>
                    <th width="80px" style="text-align:left">Uom</th>
                    <th width="100px" style="text-align:right">Diskon</th>
                    <th width="120px" style="text-align:right">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $totalPrice = 0;
                    $totaldiskon = 0;
                    $totalQty = 0;
                    $total = 0;
                    $gt = 0;
                @endphp
                @foreach($order as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->nama_produk }}</td>
                    <td style="text-align:right">{{ number_format($row->harga_jual) }}</td>
                    <td style="text-align:centre">{{ $row->qty_terima }}</td>
                    <td style="text-align:left">{{ $row->uom_id }}</td>
                    <td style="text-align:right">{{ number_format(($row->diskon/100)*($row->harga_jual * $row->qty_terima)) }}</td>
                    <td style="text-align:right">{{ number_format($row->harga_jual * $row->qty_terima) }}</td>
                </tr>

                @php
                    $totalPrice += $row->harga_jual;
                    $totaldiskon += ($row->diskon/100)*($row->harga_jual * $row->qty_terima) ;
                    //$totalQty += $row->qty_terima;
                    $totalQty += count($no);
                    $total += ($row->harga_jual * $row->qty_terima);
                    $gt = $total-$totaldiskon;
                @endphp
                @endforeach


            </tbody>
            <tfoot>                
            </tfoot>
        </table>
        <hr>
        <table border="0" class="responsive-table" width="100%">
            <tr>
                    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><!--
                    <td style="text-align:right">Rp {{ number_format($totalPrice) }}</td>
                    <td style="text-align:centre">{{ number_format($totalQty) }} Item</td>-->
                    <td >Subtotal</td>
                    <td>:</td>
                    <td style="text-align:right">{{ number_format($total) }}</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td><!--
                    <td style="text-align:right">Rp {{ number_format($totalPrice) }}</td>
                    <td style="text-align:centre">{{ number_format($totalQty) }} Item</td>-->
                    <td >Total Diskon</td>
                    <td>:</td>
                    <td style="text-align:right">{{ number_format($totaldiskon) }}</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td><!--
                    <td style="text-align:right">Rp {{ number_format($totalPrice) }}</td>
                    <td style="text-align:centre">{{ number_format($totalQty) }} Item</td>-->
                    <td >Total Penjualan</td>
                    <td>:</td>
                    <td style="text-align:right">{{ number_format($gt) }}</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td><!--
                    <td style="text-align:right">Rp {{ number_format($totalPrice) }}</td>
                    <td style="text-align:centre">{{ number_format($totalQty) }} Item</td>-->
                    <td >Pembayaran</td>
                    <td>:</td>
                    <td style="text-align:right">{{ number_format($orders->uang_muka) }}</td>
                </tr>
                <tr><td colspan="3">&nbsp;</td><td colspan="3"><hr></td></tr>
                <tr>
                    <td colspan="3">&nbsp;</td><!--
                    <td style="text-align:right">Rp {{ number_format($totalPrice) }}</td>
                    <td style="text-align:centre">{{ number_format($totalQty) }} Item</td>-->
                    <td >Saldo Terutang</td>
                    <td>:</td>
                    <td style="text-align:right">{{ number_format($gt-$orders->uang_muka,2) }}</td>
                </tr>           
        </table>
        <table border="0px">
            <tr>
                <td width="240px" style="text-align:center;">Diterima oleh,<br><br><br>(.....................)</td>
                <td width="580px" style="text-align:center">Hormat Kami,<br><br><br>(.....................)</td>
            </tr>
        </table>
    </div>
</body>
<!-- Bootstrap -->
<script src="{{ asset('bower_components/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</html>
