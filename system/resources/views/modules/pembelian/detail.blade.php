@extends('layouts.app')



@section('content')
<div class="row">
<div class="pull-right">
	
{{ link_to_route('pembelian.index', 'Kembali', [$pembelian->no_faktur], ['class' => 'btn btn-primary']) }}
    
</div>
<h4 class="page-header"><small>No. Faktur : </small> {{ $pembelian->no_faktur }} </h4>
<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Detail Pembelian</h3></div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <tbody>
                        <tr><td>No Faktur</td><td> : </td><td class="text-primary strong">{{ $pembelian->no_faktur }}</td></tr>
                        <tr><td>Tanggal</td><td> : </td><td>{{ $pembelian->tanggal_faktur }}</td></tr>
                        <?php
                            $supplier = App\Kontak::where('id', $pembelian->kontak_id)->select('nama_kontak')->first();
                            //$pd = App\PembelianDetail::where('pembelian_id', $pembelian->id)->select('total_setelah_pajak')->first();
                            $nilai = $pembelian->saldo_terutang;
                            $total =  $pembelian->total_setelah_pajak;
                        ?>
                        <tr><td>Supplier</td><td> : </td><td>{{ $supplier->nama_kontak }}</td></tr>
                        <tr><td>No PO</td><td> : </td><td>{{ $pembelian->no_po }}</td></tr>
                        <tr><td width="100px">Biaya Lain-Lain</td><td> : </td><td style="text-align: right;">{{ number_format($pembelian->biaya_lain) }}</td></tr>
                        <tr><td width="100px">Nilai Pembelian</td><td> : </td><td style="text-align: right;"><b>{{ number_format($total) }}</b></td></tr>
                        <tr><td width="100px">Uang Muka</td><td> : </td><td style="text-align: right;">{{ number_format($pembelian->uang_muka) }}</td></tr>
                        <tr><td width="100px">Saldo Terutang</td><td> : </td><td style="text-align: right;"><b>{{ number_format($nilai) }}</b></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Detail Rincian Barang</h3></div>
        <div class="panel-body">
            <table class="table table-condensed">
            <thead>
                <tr>
                    <th >{{ trans('app.table_no') }}</th>
                    <th>Produk</th>
                    <th style="text-align: right;">Qty Beli</th>
                    <th style="text-align: right;">Qty Pesan</th>
                    <th style="text-align: center;">Satuan</th>
                    <th style="text-align: right;">Harga Beli</th>
                    <th style="text-align: right;">Total</th>
                    <th style="text-align: right;">Diskon</th>
                    <th style="text-align: right;">Pajak</th>
                </tr>
            </thead>
            <?php $no = 0;?>
            <?php $total = 0; ?>
            <?php $totalpajak = 0; ?>
            <?php $totalamount = 0; ?>
            @foreach($pembelian_detail as $items)
            <tbody>
            <?php $no++ ;?>
                <tr>
                    <td>{{ $no }}</td>
                    <?php
                      $produk = App\Product::where('id', $items->kode_produk)->select('nama_produk')->first();
                      $amount = $items->qty_terima * $items->harga_beli;
                      $diskonrp = $amount*$items->diskon/100;
                      $amount2   = $amount-$diskonrp;
                      $pajakrp  = $amount2*$items->pajak/100; 
                    ?>
                    <?php $total += $diskonrp; ?>
                    <?php $totalpajak += $pajakrp; ?>
                    <?php $totalamount += $amount; ?>
                    <td>{{ $produk->nama_produk }}</td>
                    <td style="text-align: right;">{{ $items->qty_terima }}</td>
                    <td style="text-align: right;">{{ $items->qty_pesan }}</td>
                    <td style="text-align: center;">{{ $items->uom_id }}</td>
                    <td style="text-align: right;">{{ number_format($items->harga_beli) }}</td>
                    <td style="text-align: right;">{{ number_format($amount) }}</td>
                    <td style="text-align: right;">{{ $items->diskon }} %</td>                    
                    <td style="text-align: right;">{{ $items->pajak }} %</td>                                       
                </tr>
            </tbody>
            @endforeach
            <tfoot> 
                <tr style="border-style: hidden;">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">Total Pembelian :</th>
                    <th style="text-align: right;" colspan="2">{{number_format($totalamount)}}</th>
                </tr>
                <tr style="border-style: hidden;">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">Total Diskon :</th>
                    <th style="text-align: right;" colspan="2">{{number_format($total)}}</th>
                </tr>
                <tr style="border-style: hidden;">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">Total Sebelum Pajak :</th>
                    <th style="text-align: right;" colspan="2">{{number_format($totalamount - $total)}}</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><span></span></th>
                    <th style="text-align: right;">Total Pajak :</th>
                    <th style="text-align: right;" colspan="2">{{number_format($totalpajak)}}</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><span></span></th>
                    <th style="text-align: right;">Total Setelah Pajak :</th>
                    <th style="text-align: right;" colspan="2">{{number_format($totalamount - $total + $totalpajak)}}</th>
                </tr>
            </tfoot>
            
        </table>
        </div>
    </div>
    </div>
</div>
</div>
@endsection

@push('javascripts')

@endpush