@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('css')
<!--
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">
-->
<style type="text/css">
    .warna-text {
       color: #FFFFFF;
    }
    .warna-dasar {

    }
</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.css">
<link rel="stylesheet" type="text/css" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css">

@stop


@section('content')

{!!Form::open(array('route'=>'penjualan.insert','id'=>'frmsave','method'=>'post'))!!}
<input type="text" name="user_id" hidden="true" id="user_id" value="{{ Auth::user()->id }}" />

<div class="row">
    <div class="col-xs-12">

        <div class="panel panel-default">

        <div class="panel-heading">
            Buat Faktur Penjualan
        </div>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="panel-body  table-responsive">

            <div class="form-group col-lg-6">

                <div class="col-sm-4">
                {!! Form::label('jenis_penjualan', 'Jenis Penjualan :', ['class' => 'control-label']) !!}
                {!! Form::select('jenis_penjualan', [
                    '1' => 'Retail',
                    '2' => 'Reseller',
                ], 1, ['class' => 'form-control']) !!}
                </div>

                <div class="col-sm-8">
                {!! Form::label('kontak_id', 'Nama Pelanggan/Reseller :', ['class' => 'control-label']) !!}
                <div class="input-group">
                {{ Form::hidden('kontak_id', null, array('id'=>'kontak_id', 'class' => 'form-control')) }}
                {{ Form::text('nama_kontak', null, array('id'=>'nama_kontak','class' => 'form-control', 'placeholder'=>'Nama Pelanggan/Reseller', 'readonly'=>'true')) }}
                <span class="input-group-btn">
                <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModalKontak" id="btn" data-backdrop="static" data-keyboard="false" disabled="true">Cari</button>
                </span>
                </div>
                </div>

                <div class="col-sm-6">
                {!! Form::label('no_faktur', 'No Faktur/Transaksi :', ['class' => 'control-label']) !!}
                {!! Form::text('no_faktur', $invoice, ['style'=>'background: #eee','class' => 'form-control', 'readonly' => 'true']) !!}
                </div>
                <p class="help-block"></p>
                @if($errors->has('no_faktur'))
                <p class="help-block">
                      {{ $errors->first('no_faktur') }}
                </p>
                @endif

                <!--
                <div class="col-sm-6">
                {!! Form::label('no_po', 'No. Pesanan :', ['class' => 'control-label']) !!}
                {!! Form::text('no_po', old('no_po'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <p class="help-block"></p>
                @if($errors->has('no_po'))
                <p class="help-block">
                      {{ $errors->first('no_po') }}
                </p>
                @endif
                -->

                <div class="col-sm-6">
                {!! Form::label('tanggal_faktur', 'Tanggal Faktur :', ['class' => 'control-label']) !!}
                <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" name="tanggal_faktur" id="tanggal_faktur" placeholder="Tanggal Faktur" value="01/03/2018">
                </div>
                </div>

                <!--
                        <div class="col-sm-6">
                {!! Form::label('proyek', 'Proyek :', ['class' => 'control-label']) !!}
                {!! Form::text('proyek', old('proyek'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <p class="help-block"></p>
                @if($errors->has('proyek'))
                <p class="help-block">
                      {{ $errors->first('proyek') }}
                </p>
                @endif
                -->



            </div>

            <div class="form-group col-lg-6">

                <div class="col-sm-6">
                <?php
                    $id =  Auth::user()->gudang_id;
                    $gudang = App\Gudang::where('id', $id)->first();

                    $idd =  Auth::user()->departement_id;
                    $departement = App\Departement::where('id', $idd)->first();
                ?>
                {!! Form::label('gudang_masuk_id', 'Keluar dari Gudang :', ['class' => 'control-label']) !!}
                {!! Form::hidden('gudang_masuk_id', $gudang->id, ['class' => 'form-control', 'readonly' => 'true']) !!}
                {!! Form::text('gudang_masuk_id2', $gudang->nama_gudang, ['class' => 'form-control', 'readonly' => 'true']) !!}
                </div>


                <div class="col-sm-6">
                {!! Form::label('departement_id', 'Departement/Asal Cabang :', ['class' => 'control-label']) !!}
                {!! Form::hidden('departement_id',  $departement->id, ['class' => 'form-control', 'readonly' => 'true']) !!}
                {!! Form::text('departement_id2',  $departement->nama_departement, ['class' => 'form-control', 'readonly' => 'true']) !!}
                </div>
                <p class="help-block"></p>
                @if($errors->has('no_faktur'))
                <p class="help-block">
                      {{ $errors->first('no_faktur') }}
                </p>
                @endif

               <div class="col-sm-12">
               {!! Form::label('keterangan', 'Keterangan :', ['class' => 'control-label']) !!}
               {!! Form::text('keterangan', old('keterangan'), ['class' => 'form-control', 'placeholder' => '']) !!}
               </div>
               <p class="help-block"></p>
               @if($errors->has('no_faktur'))
               <p class="help-block">
                     {{ $errors->first('no_faktur') }}
               </p>
               @endif

                <!--
                <div class="col-sm-6">
                {!! Form::label('nama_konsumen', 'Nama Konsumen :', ['class' => 'control-label']) !!}
                {!! Form::text('nama_konsumen', old('nama_konsumen'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>

                <div class="col-sm-6">
                {!! Form::label('alamat_konsumen', 'Alamat Konsumen :', ['class' => 'control-label']) !!}
                {!! Form::text('alamat_konsumen', old('alamat_konsumen'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>

                <div class="col-sm-6">
                {!! Form::label('kota_konsumen', 'Kota Konsumen :', ['class' => 'control-label']) !!}
                {!! Form::text('kota_konsumen', old('kota_konsumen'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>

                <div class="col-sm-6">
                {!! Form::label('desa_konsumen', 'Desa Konsumen :', ['class' => 'control-label']) !!}
                {!! Form::text('desa_konsumen', old('desa_konsumen'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>

                <div class="col-sm-6">
                {!! Form::label('provinsi_konsumen', 'Provinsi Konsumen :', ['class' => 'control-label']) !!}
                {!! Form::text('provinsi_konsumen', old('provinsi_konsumen'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>

                <div class="col-sm-6">
                {!! Form::label('hp_konsumen', 'HP Konsumen :', ['class' => 'control-label']) !!}
                {!! Form::text('hp_konsumen', old('hp_konsumen'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>

                <div class="col-sm-12">
                {!! Form::label('expedisi', 'Ekspedisi :', ['class' => 'control-label']) !!}
                {!! Form::text('expedisi', old('expedisi'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                -->
            </div>

            <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>

            <div class="form-group">
            <div class="col-md-12">
            <div>
                <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Cari Produk</button>
            </div>
            <br>
                <table class="table table-no-bordered table-responsive" id="item_table">
                    <thead style="background: #696969;">
                        <th class="warna-text">&nbsp;Kode</th>
                        <th class="warna-text">&nbsp;Deskripsi Produk</th>
                        <!--
                        <th class="warna-text">Kode Akun</th>-->
                        <th class="warna-text" style="text-align: right;">Qty Jual&nbsp;</th>
                <!--
                        <th class="warna-text">Dipesan</th>-->
                        <th class="warna-text">Satuan</th>
                        <th class="warna-text" style="text-align: right;">Harga&nbsp;</th>
                        <th class="warna-text" style="text-align: center;">Diskon</th>
                        <th class="warna-text" style="text-align: right;">SubTotal&nbsp;</th>
		<!--
                        <th class="warna-text">Pajak</th>-->
                <!--
                        <th class="warna-text">Proyek</th>-->
                        <th width="5%" style="text-align: center;background: #eee"><a href="#" class="addRow" title="Tambah Baris"><i class="glyphicon glyphicon-plus"></i></a></th>
                    </thead>
                    <tbody  style="background: #eee;" id="item_body" >
                        <tr id="item_tr">
                            <td width="15%">
                              <input type="hidden" name="produk_id[]" class="form-control calcEvent input-sm produk_id" id="produk_id">
                              <input type="text" name="kode_produk[]" class="form-control calcEvent input-sm kode_produk" id="kode_produk">
                            </td>
                            <td width="25%">
                                <div class="input-group">
                                     <input type="text" name="nama_produk[]" class="form-control calcEvent input-sm nama_produk" id="nama_produk">
                                     <span class="input-group-btn">
                                     <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Cari</button>
                                     </span>
                                </div>
                            </td>
                            <!--
                            <td width="10%"><input type="text" name="akun_id[]" class="form-control calcEvent input-sm  akun_id" id="akun_id"></td>-->
                            <td width="10%"><input type="text" id="qty" name="qty[]" style="text-align: right;" class="form-control calcEvent input-sm totalsetelahpajak(); qty"></td>
                            <!--
                            <td width="5%"><input type="text" name="qty_pesan[]" style="text-align: right;" class="form-control input-sm totalsetelahpajak();  qty_pesan"></td>

                            <td width="8%">
                            <input type="text" name="uom_id[]" class="form-control uom_id">
                            </td>-->

                            <td width="15%">
                                <select class="form-control input-sm calcEvent  uom_id" name="uom_id[]" id="uom_id">
                                <option value="0" selected="true" disabled="true">Pilih Satuan</option>
                                @foreach($uoms_list as $key => $p)
                                <option value="{!!$key!!}">{!!$p!!}</option>
                                @endforeach
                            </td>

                            <td width="10%"><input type="text" id="harga" name="harga[]" style="text-align: right;" class="form-control calcEvent input-sm  harga"></td>
                            <td width="10%"><input type="text" id="discount" name="discount[]" style="text-align: center;" class="form-control calcEvent input-sm  discount"></td>
                            <td width="15%"><input type="text" id="amount" name="amount[]" style="text-align: right; background: #eee;" class="form-control calcEvent input-sm  amount" readonly="true"></td>
                            <!--<td width="0%"><input type="hidden" id="pajak" name="pajak[]" style="text-align: center;"  class="form-control calcEvent input-sm  pajak"></td>
                            <td width="5%"><input  type="text" name="proyek2[]" class="form-control input-sm  proyek2"></td>-->
                            <td width="0%" hidden="true" ><input  type="hidden" id="proyek1" name="proyek1[]" class="form-control calcEvent input-sm  proyek1"></td>

                            <td width="5%" style="text-align: center;"><a href="#" class="btn btn-xs btn-danger remove"><i class="glyphicon glyphicon-minus"></i></a></td>

                        </tr>
                    </tbody>
              </table>

            </div>
            </div>

                <div class="form-group">
                    <div class="form-group">
                    <div class="col-sm-2">
                    {!! Form::label('tanggal_kirim', 'Tanggal Pengiriman :', ['class' => 'control-label']) !!}
                    <input type="text" class="form-control" name="tanggal_kirim" id="tanggal_kirim" placeholder="Tanggal Pengiriman" value="01/03/2018">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-sm-2">
                    {!! Form::label('bagian_pembelian', 'Bagian Pembelian :', ['class' => 'control-label']) !!}
                    <input type="text" class="form-control" name="bagian_pembelian" id="bagian_pembelian" placeholder="">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-sm-2">

                    </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-2">

                    </div>
                    </div>

                </div>

                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">Biaya-biaya lain :</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <input placeholder="0.0" name="biaya_lain" id="biaya_lain" class="biaya_lain form-control" type="text" style="text-align: right;" >
                       <input type="hidden" id="bl" name="bl" class="form-control bl" hidden="true">
                    </div>
                </div>
                </div>


                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>

                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">Total Pajak :</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <input type="text" name="totalpajak" class="form-control totalpajak" style="text-align: right;background: #eee;" readonly="true">
                    </div>
                </div>
                </div>

                <!-- -->
                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>

                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>

                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">Total Setelah Pajak :</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <input type="text" name="totalsetelahpajak" class="form-control totalsetelahpajak" style="text-align: right;background: #eee;" readonly="true">
                       <input type="hidden" id="totalsetelahpajak2" name="totalsetelahpajak2" class="form-control totalsetelahpajak2" hidden="true">
                       <input type="hidden" id="totalsetelahpajak3" name="totalsetelahpajak3" class="form-control totalsetelahpajak3" hidden="true">
                    </div>
                </div>
                </div>
                <!-- -->

                <div class="form-group">
                    <div class="form-group">
                    <div class="col-sm-2">
                    {!! Form::label('denda_terlambat', 'Term Pembayaran :', ['class' => 'control-label']) !!}
                    <input type="text" class="form-control" name="denda_terlambat" id="denda_terlambat" placeholder="% Net 0">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-sm-2">
                    {!! Form::label('debit_kredit', 'Nota Debit/Kredit :', ['class' => 'control-label']) !!}
                    <input type="text" class="form-control" name="debit_kredit" id="debit_kredit" placeholder="">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-sm-2">

                    </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-2">

                    </div>
                    </div>
                </div>


                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>

                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>

                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">Uang Muka :</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <input name="uang_muka" id="uang_muka" class=" form-control uang_muka" type="text" style="text-align: right;" placeholder="0.0">
                    </div>
                </div>
                </div>

                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>

                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>

                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">Total :</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <input type="text" name="saldo_terutang" class="form-control saldo_terutang" style="text-align: right;background: #eee;" readonly="true">
                    </div>
                </div>
                </div>


            </div>


    </div>
    </div>


        <div class="col-lg-2 col-sm-2">
            <div class="form-group">
                <a href="{{route('penjualan.index')}}" class="btn btn-primary">Batal</a>
                {!!Form::submit('Rekam', array('class'=>'btn btn-primary'))!!}
            </div>
        </div>

        <div class="form-group">
            <!--
            <input type="checkbox" name="is_cetak[]" value="Y" class="flat"> <label><b> Cetak</b></label>
            <input type="checkbox" name="is_tunai[]" value="Y" class="flat"> <label><b> Tunai</b></label>
            -->

            {!! Form::checkbox('is_cetak', 'Y', null, ['class' => 'flat']) !!}
            {!! Form::label('is_cetak', 'Cetak Faktur Penjualan/Transaksi', ['class' => 'control-label']) !!} &nbsp;&nbsp;


            {!! Form::checkbox('is_tunai', 'Y', null, ['class' => 'flat']) !!}
            {!! Form::label('is_tunai', ' Tunai', ['class' => 'control-label']) !!}



        </div>
</div>


        <!--
        <div class="form-group">
          <label for="is_cetak" class="col-sm-3 control-label">Bebas SPP</label>
          <div class="col-sm-9">
            <input type="checkbox" name="is_cetak" value="1" class="flat-red"  >
          </div>
        </div>
        -->

        <!-- Modal -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Daftar Produk</h4>
                    </div>
                    <div class="modal-body">

                      <div class="table-responsive">

                          <div class="row">
                            <div class="col-md-12">
                                <div class="grid simple ">

                                    <div class="grid-body no-border">
                                          <!--
                                          <h3>Pilih  <span class="semi-bold">Kepala Desa</span></h3>
                                          <table id="example3" class="table no-more-tables">
                                          -->
                                            <table id="table_produk" class="table display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th style="width:1%">
                                                            #
                                                        </th>
                                                        <th style="width:15%">Kode Produk</th>
                                                        <th style="width:35%">Nama Produk</th>
                                                        <th style="width:25%">Harga Jual Standar</th>
                                                        <th style="width:24%">Stok</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                          @foreach($product_list as $data)
                          <tr class="produk">
                            <?php

                            $id = $data->id;

                            ?>
                            <td width="1px" class="v-align-middle warna-text" hidden="true" >
                                {{ $data->id }}
                            </td>
                            <td class="v-align-middle">{{ $data->kode_produk }}</td>
                            <td class="v-align-middle">{{ $data->nama_produk }}</td>
                            <th class="v-align-middle" style="text-align: right;">{{ number_format($data->harga_jual_satuan,2) }}</th>
                            <th class="v-align-middle" style="text-align: right;">{{ $data->stok }}</th>
                          </tr>
                        @endforeach
                        </tbody>
                        </table>
                        </div>
                        </div>
                        </div>
                        </div>
                      </div>
                      <!-- end table-responsive -->

                    </div>
                    <div class="modal-footer">
                      <!--
                      <input type="button" class="btn btn-success" id="btn" value="Pilih Produk"/> -->
                      <input type="button" class="btn btn-success" id="btnx" value="Pilih Produk"/>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Modal <script type="text/javascript" src="{{ asset('js/kades.js')}}"> </script>-->


        @include('kontak.modalkontak')




{!! Form::close() !!}
@stop

@push('javascripts')
    <!-- DataTables
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    -->
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('/js/pembelian.js')}}"></script>
    <script src="{{asset('/bower_components/autoNumeric/src/AutoNumeric.js')}}" type="text/javascript"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.js"></script>
    <script type="text/javascript" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            searchbox.init();
            //validation.init();
        });
    </script>

<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>

<script type="text/javascript">
    $( document ).ready(function() {

    $('#jenis_penjualan').on('change', function() {
       if(this.value == 1)
           $('#btn').attr("disabled", true);
        else
           $('#btn').attr("disabled", false);
    });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#tabel_kontak').DataTable({
        select: 'single'
    });

    document.getElementById('btn_kontakx').onclick = function()
    {
      let rows   = table.rows( { selected: true } );
      var result = table.cells( rows.nodes(), 0 ).data();
      //console.log(result);
      //alert(result[0]);
      var id = result[0];
      var dataId={'id':id};

      $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('pembelian.findKontak')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    $('#nama_kontak').val(data.nama_kontak);
                    $('#kontak_id').val(data.id);
                    $('#myModalKontak').modal('hide');
                }
          });

    };

    });
</script>

<script type="text/javascript">
    $( document ).on("click change paste keyup", ".calcEvent", function() {
       total();
       totalpajak();
       totalsetelahpajak();
       calcTotals()
    });


    function calcTotals(){
    var subTotal    = 0;
    var total       = 0;
    var amountDue   = 0;
    var totalTax    = 0;
    $('tr.item').each(function(){
        var quantity    = parseFloat($(this).find("[id='qty']").val()) > 0 ? parseFloat($(this).find("[id='qty']").val()) : 0;
        var price       = parseFloat($(this).find("[id='harga']").val()) > 0 ? parseFloat($(this).find("[id='harga']").val()) : 0;
        var disc_pct    = parseFloat($(this).find("[id='discount']").val()) > 0 ? parseFloat($(this).find("[id='discount']").val()) : 0;
        //var itemTax     = $(this).find("[id='tax']").val();
        var itemTotal   = parseFloat(quantity * price) > 0 ? parseFloat(quantity * price) : 0;
        //var taxValue    = $(this).find("[id='tax'] option[value='" + itemTax + "']").attr('data-value');
        var taxValue    = 0;//parseFloat($(this).find("[id='pajak']").val()) > 0 ? parseFloat($(this).find("[id='pajak']").val()) : 0;
        var disc_rp     =  parseFloat(quantity * price * disc_pct/100)  > 0 ? parseFloat(quantity * price * disc_pct/100) : 0;
        subTotal        += parseFloat(price * quantity - disc_rp) > 0 ? parseFloat(price * quantity - disc_rp) : 0;
        totalTax        += parseFloat(price * quantity * taxValue/100) > 0 ? parseFloat(price * quantity * taxValue/100) : 0;
        //$(this).find(".amount").text( itemTotal.toFixed(2) );
        //alert(subTotal);
        $(this).find(".amount").val(subTotal);
    });
    var discount_mode = parseInt($("[id='discount_mode']").val());
    var discount    = parseFloat($("[id='discount']").val()) > 0 ? parseFloat($("[id='discount']").val()) : 0;
    var paid        = parseFloat($("#paidAmount").val()) > 0 ? parseFloat($("#paidAmount").val()) : 0;
    var discount_amount = discount_mode == 1 ? subTotal * (discount/100) : discount;
    total           += parseFloat(subTotal+totalTax-discount_amount);
    amountDue       += parseFloat(subTotal+totalTax-discount_amount-paid);
    $( '#subTotal' ).text( subTotal.toFixed(2) );
    $( '#taxTotal' ).text( totalTax.toFixed(2) );
    $( '#grandTotal' ).text( total.toFixed(2) );
    $( '#amountDue' ).text( amountDue.toFixed(2) );
    }

</script>

<script type="text/javascript">
$(document).ready(function() {
    var table = $('#table_produk').DataTable({
      //'ajax': 'https://api.myjson.com/bins/1us28',
      'ajax': '{{ route("products.ajax")}}',
      'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[2, 'asc']]
   });

    document.getElementById('btnx').onclick = function()
    {
      var rows_selected = table.column(0).checkboxes.selected();
      var rows = rows_selected;

      $.each(rows, function(index, rowId){

      var dataId = {'id':rowId};

      $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('products.findProduk')!!}',
                dataType: 'json',
                data    : dataId,
                success : function(data){

                    var products = data.products;

                    for(var key in products) {

                        var last_row = $('#item_table tr:last');
                        if (last_row.find('input[id=nama_produk]').val() !== '')
                        {
                                addRow('item_table');
                                var last_row = $('#item_table tr:last');
                                last_row.find('input[id=nama_produk]').val(products[key].nama_produk);
                                last_row.find('input[id=produk_id]').val(products[key].id);
                                last_row.find('input[id=kode_produk]').val(products[key].kode_produk);
                                last_row.find('input[id=harga]').val(products[key].harga_jual_satuan);
                                last_row.find('input[id=qty]').val('0');
                                last_row.find('input[id=discount]').val('0');
                                last_row.find('input[id=pajak]').val('0');
                                last_row.find('input[id=amount]').val('0');
                                last_row.find('input[id=proyek1]').val('0');
                                last_row.find('input[id=proyek2]').val('0');
                                $('.biaya_lain').val(0);
                                $('.uang_muka').val(0);
                                $('.saldo_terutang').val(0);

                            }
                            else
                            {
                                last_row.find('input[id=nama_produk]').val(products[key].nama_produk);
                                last_row.find('input[id=produk_id]').val(products[key].id);
                                last_row.find('input[id=kode_produk]').val(products[key].kode_produk);
                                last_row.find('input[id=harga]').val(products[key].harga_jual_satuan);
                                last_row.find('input[id=qty]').val('0');
                                last_row.find('input[id=discount]').val('0');
                                last_row.find('input[id=pajak]').val('0');
                                last_row.find('input[id=amount]').val('0');
                                last_row.find('input[id=proyek1]').val('0');
                                last_row.find('input[id=proyek2]').val('0');
                                $('.biaya_lain').val(0);
                                $('.uang_muka').val(0);
                                $('.saldo_terutang').val(0);

                        }
                        $('#myModal').modal('hide').reset();
                    }

                }
          });

        });
    };

  });

</script>

    <script type="text/javascript">
        $(document).ready(function() {
             // set an element
             //$("#date").val(moment().format('dd-mm-yyyy'));
             // set a variable
             //var today = moment().format('dd-mm-yyyy');
            $("#tanggal_faktur").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        }).datepicker("setDate", new Date());
        //.on("changeDate", function(e) {
            // Revalidate the date field
          //  $("#frmData").formValidation("revalidateField", "tanggal_faktur");
        //});
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
             // set an element
             //$("#date").val(moment().format('dd-mm-yyyy'));
             // set a variable
             //var today = moment().format('dd-mm-yyyy');
            $("#tanggal_kirim").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        }).datepicker("setDate", new Date());
        //.on("changeDate", function(e) {
            // Revalidate the date field
          //  $("#frmData").formValidation("revalidateField", "tanggal_kirim");
        //});
        });
    </script>



    <script type="text/javascript">

        $('tbody').delegate('.nama_produk','change',function(){
            var tr=$(this).parent().parent();
            var id = tr.find('.nama_produk').val();
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('penjualan.findKodeProduk')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    tr.find('.kode_produk').val(data.kode_produk);
                }
            });
        });


        $('tbody').delegate('.nama_produk','change',function(){
            var tr=$(this).parent().parent();
            var id = tr.find('.nama_produk').val();
            var kontak_id = document.getElementById("kontak_id").value;
            var dataId = {
                          'id':id,
                          'kontak_id':kontak_id
                         };
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('penjualan.findSatuan')!!}',
                dataType: 'json',
                data    : dataId,

                success:function(data){
                   // alert(data.uom_id);
                    tr.find('.uom_id').val(data.uom_id);
                }
            });
        });

	/*
        $('tbody').delegate('.nama_produk','change',function(){
            var tr=$(this).parent().parent();
            var id = tr.find('.nama_produk').val();
            var kontak_id = document.getElementById("kontak_id").value;
            var dataId = {
                          'id':id,
                          'kontak_id':kontak_id
                         };
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('penjualan.Price')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    tr.find('.harga').val(data.harga_jual_satuan);
                }
            });
        });
	*/

	$('tbody').delegate('.uom_id','change paste keyup',function(){
            var tr=$(this).parent().parent();
            var id = tr.find('.produk_id').val();
            var uom_id = tr.find('.uom_id').val();
            var kontak_id = document.getElementById("kontak_id").value;
	    //alert(id+kontak_id+uom_id);
            var dataId = {
                          'id':id,
                          'kontak_id':kontak_id,
                          'uom_id':uom_id
                         };
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('penjualan.Price')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    tr.find('.harga').val(data.harga_jual_satuan);

		    var qty = tr.find('.qty').val();
	            var price = data.harga_jual_satuan;
		    var disk = tr.find('.discount').val() > 0 ? tr.find('.discount').val() : 0;
	            var disk_rp = (qty*price)*(disk/100);
		    var sub = (qty*price)-(disk_rp);
		    //alert(qty+'x'+price+'='+sub+','+disk+','+disk_rp);
	            tr.find('.amount').val(sub);


                }
            });
        });

        $('tbody').delegate('.nama_produk','change',function(){
            //alert('sadsad');
            var tr=$(this).parent().parent();
            tr.find('.qty').focus();
        });

        $('tbody').delegate('.qty,.harga,.discount', 'click change paste keyup',function(){
            //alert('sadsad');
            var tr =$(this).parent().parent();
            var qty =tr.find('.qty').val();
            var harga =tr.find('.harga').val();
            var discount =tr.find('.discount').val();
            var amount = (qty * harga) - (qty * harga * discount)/100;
            tr.find('.amount').val(amount);

            total();
            totalpajak();
            totalsetelahpajak();
            calcTotals();
        });

        $('tbody').delegate('.qty,.uom_id,.harga,.discount,.pajak', 'click change paste keyup',function(){
            //alert('pajak :');
            var tr =$(this).parent().parent();
            var amount =tr.find('.amount').val();
            var pajak =tr.find('.pajak').val();

            var pajakrp = amount * (pajak/100);
            tr.find('.proyek1').val(pajakrp);
            //alert(pajakrp);

            total();
            totalpajak();
            totalsetelahpajak();
            calcTotals();
        });

        $('body').delegate('.qty,.uom_id,.harga,.discount,.pajak,.biaya_lain','click change paste keyup', function(){

            var x = document.getElementById("totalsetelahpajak2").value;
            var biaya_lain = document.getElementById("biaya_lain").value;
            total22 = parseInt(x) + parseFloat(biaya_lain);

            $('.totalsetelahpajak').val("Rp. "+total22.formatMoney(2,'.',','));
            $('.totalsetelahpajak3').val(total22);

        });


        $('body').delegate('.qty,.uom_id,.harga,.discount,.pajak,.biaya_lain,.uang_muka','click change paste keyup', function(){

            var m = document.getElementById("totalsetelahpajak3").value > 0 ? document.getElementById("totalsetelahpajak3").value : 0;
            var uang_muka = document.getElementById("uang_muka").value > 0 ? document.getElementById("uang_muka").value : 0;

            //alert(m + uang_muka);

            saldo_terutang = parseInt(m) - parseFloat(uang_muka);

            $('.saldo_terutang').val("Rp. "+saldo_terutang.formatMoney(2,'.',','));

        });

        $('.addRow').on('click',function(){
            addRow();
        });

        function total2()
        {
            var x = document.getElementById("totalsetelahpajak2").value;
            var biaya_lain = $(this).val();

            total22 = parseInt(x) + parseInt(biaya_lain);

            $('.totalsetelahpajak').val("Rp. "+total22.formatMoney(2,'.',','));

        };

        function total()
        {
            var total =0;
            $('.amount').each(function(i,e){
                var amount = $(this).val()-0;
                total +=amount;
            })
            $('.total').html("Rp. "+total.formatMoney(2,'.',','));
            //$('.saldo_terutang').val(total);
            //tr.find('.subtotal').val("Rp. "+total.formatMoney(2,',','.'));
        };


        function totalpajak()
        {
            var totalpajak =0;
            $('.proyek1').each(function(i,e){
                var proyek1 = 0;//$(this).val()-0;
                totalpajak +=proyek1;
            })

            $('.totalpajak').html("Rp. "+totalpajak.formatMoney(2,'.',','));
            $('.totalpajak').val("Rp. "+totalpajak.formatMoney(2,'.',','));
        };

        function totalsetelahpajak(){
            //var total = total();
            var totalsetelahpajak = 0;

            var totalpajak =0;
            $('.proyek1').each(function(i,e){
                var proyek1 = 0;//$(this).val()-0;
                totalpajak +=proyek1;
            });

            var total =0;
            $('.amount').each(function(i,e){
                var amount = $(this).val()-0;
                total +=amount;
            });

            totalsetelahpajak = total + totalpajak;
            $('.totalpajak').html("Rp. "+totalpajak.formatMoney(2,'.',','));
            $('.totalsetelahpajak').val("Rp. "+totalsetelahpajak.formatMoney(2,'.',','));
            $('.totalsetelahpajak2').val(totalsetelahpajak);
            //$('.saldo_terutang').val("Rp. "+totalsetelahpajak.formatMoney(2,'.',','));
            //$('.uang_muka').val("Rp. "+totalsetelahpajak.formatMoney(2,'.',','));
        };

        //------------------formatMoney----------------
        Number.prototype.formatMoney = function(c, d, t){
        var n = this,
            c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;
           return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
         };
        //---------------------------------------------
        function addRow()
        {
            var tr =  '<tr>'+
                            '<td width="14%"><input type="hidden" name="produk_id[]" class="form-control calcEvent input-sm produk_id" id="produk_id"><input type="text" name="kode_produk[]" class="form-control calcEvent input-sm kode_produk" id="kode_produk"></td>'+
                            '<td width="20%">'+
                                '<div class="input-group">'+
                                     '<input type="text" name="nama_produk[]" class="form-control calcEvent input-sm nama_produk" id="nama_produk">'+
                                     '<span class="input-group-btn">'+
                                     '<button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Cari</button>'+
                                     '</span>'+
                                '</div>'+
                            '</td>'+
                            '<!--<td width="10%"><input type="text" name="akun_id[]" class="form-control calcEvent input-sm  akun_id" id="akun_id"></td>-->'+
                            '<td width="10%"><input type="text" id="qty" name="qty[]" style="text-align: right;" class="form-control calcEvent input-sm totalsetelahpajak(); qty"></td>'+
                            '<!--<td width="5%"><input type="text" name="qty_pesan[]" style="text-align: right;" class="form-control input-sm totalsetelahpajak();  qty_pesan"></td>'+

                            '<td width="15%">'+
                            '<input type="text" name="uom_id[]" class="form-control uom_id">'+
                            '</td>-->'+

                            '<td width="10%">'+
                                '<select class="form-control input-sm calcEvent  uom_id" name="uom_id[]" id="uom_id">'+
                                '<option value="0" selected="true" disabled="true">Pilih Satuan</option>'+
                                '@foreach($uoms_list as $key => $p)'+
                                '<option value="{!!$key!!}">{!!$p!!}</option>'+
                                '@endforeach'+
                            '</td>'+

                            '<td width="10%"><input type="text" id="harga" name="harga[]" style="text-align: right;" class="form-control calcEvent input-sm  harga"></td>'+
                            '<td width="10%"><input type="text" id="discount" name="discount[]" style="text-align: center;" class="form-control calcEvent input-sm  discount"></td>'+
                            '<td width="10%"><input type="text" id="amount" name="amount[]" style="text-align: right; background: #eee;" class="form-control calcEvent input-sm  amount" readonly="true"></td>'+
                            '<!--<td width="0%"><input type="hidden" id="pajak" name="pajak[]" style="text-align: center;"  class="form-control calcEvent input-sm  pajak"></td>'+
                            '<td width="5%"><input  type="text" name="proyek2[]" class="form-control input-sm  proyek2"></td>-->'+
                            '<td width="0%" hidden="true" ><input  type="hidden" id="proyek1" name="proyek1[]" class="form-control calcEvent input-sm  proyek1"></td>'+

                            '<td width="5%" style="text-align: center;"><a href="#" class="btn btn-xs btn-danger remove"><i class="glyphicon glyphicon-minus"></i></a></td>'+

                        '</tr>';
            $('#item_table').append(tr);
        };

        $(document).on('click', '.remove', function() {
        //$('.remove').live('click', function(){
            //var l=$('tbody tr').length;
            var l = $('#item_body tr').length;
            if (l==1)
            {
                alert('Anda tidak bisa menghapus baris terakhir !');
            }else{
                $(this).parent().parent().remove();
            total();
            totalpajak();
            totalsetelahpajak();
            }
        });

        /*
        function number(input){
            $(input).keypress(function(evt){
                var theEvent = evt || window.event;
                var key = thead.keyCode || theEvent.which;
                key = String.fromCharCode( key );
                var regex = /[-\d\.]/;
                var objRegex = /^-?\d*[\.]?\d*$/;
            });
        };
        */
    </script>
@endpush
