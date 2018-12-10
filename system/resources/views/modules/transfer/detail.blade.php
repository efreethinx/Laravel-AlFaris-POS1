@extends('layouts.app')



@section('content')
<div class="row">
<div class="pull-right">
	
<a href="{{route('transfer.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-chevron-back"></i>Kembali</a>
    
</div>
<h4 class="page-header"><small>No. Transfer : </small> {{ $pembelian->no_reff }} </h4>
<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Detail Transfer</h3></div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <tbody>
                        <tr><td>No. Transfer</td><td> : </td><td class="text-primary strong">{{ $pembelian->no_reff }}</td></tr>
                        <tr><td>Tanggal</td><td> : </td><td>{{ $pembelian->tanggal }}</td></tr>
                        <?php
                            $supplier = App\Departement::where('id', $pembelian->departement_id)->select('nama_departement')->first();
                            //$nilai = $pembelian->saldo_terutang + $pembelian->biaya_lain - $pembelian->uang_muka;
                            //$total = $pembelian->saldo_terutang + $pembelian->biaya_lain;
                        ?>
                        <tr><td>Departement</td><td> : </td><td>{{ $supplier->nama_departement }}</td></tr>
                        <tr><td>Keterangan</td><td> : </td><td>{{ $pembelian->keterangan }}</td></tr>
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
                    <th width="10%">{{ trans('app.table_no') }}</th>
                    <th width="35%">Produk</th>
                    <th width="15%" style="text-align: right;">Qty</th>
                    <th width="15%" style="text-align: center;">Satuan</th>
                    <th width="25%" style="text-align: left;">Ke Gudang</th>
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
                      $produk = App\Product::where('id', $items->produk_id)->select('nama_produk')->first();
                      $gudang = App\Gudang::where('id', $items->ke_gudang)->select('nama_gudang')->first();
                      $amount = $items->qty_terima * $items->harga_jual;
                    ?>
                    <?php $total += $items->qty; ?>
                    <?php //$totalpajak += $pajakrp; ?>
                    <?php //$totalamount += $amount; ?>
                    <td>{{ $produk->nama_produk }}</td>
                    <td style="text-align: right;">{{ $items->qty }}</td>
                    <td style="text-align: center;">{{ $items->uom_id }}</td>                                 
                    <td style="text-align: left;">{{ $gudang->nama_gudang }}</td>                                 
                </tr>
            </tbody>
            @endforeach
            <tfoot> 
                <tr style="border-style: hidden;">
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">&nbsp;</th>
                    <th style="text-align: right;" colspan="2">&nbsp;</th>
                </tr>
                <tr style="border-style: hidden;">
                    <th></th>
                    <th style="text-align: right;" colspan="2">Total Qty Transfer :</th>
                    <th style="text-align: center;" colspan="2">{{number_format($total)}}</th>
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