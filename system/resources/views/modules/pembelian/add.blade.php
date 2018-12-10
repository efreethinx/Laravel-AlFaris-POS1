@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@push('css')
<!--
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


<link rel="stylesheet" href="{{asset('js/jqwidgets/styles/jqx.base.css')}}" type="text/css" />
<script type="text/javascript" src="{{asset('js/jqwidgets/jqxcore.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jqwidgets/jqxdata.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jqwidgets/jqxbuttons.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jqwidgets/jqxscrollbar.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jqwidgets/jqxlistbox.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jqwidgets/jqxdropdownlist.js')}}"></script>
-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">

<!--
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.19/themes/ui-lightness/jquery-ui.css" rel="stylesheet"/> , 'class'=>'form-horizontal'
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.19/jquery-ui.min.js"></script>
-->


<style type="text/css">
    .warna-text {
        color: #FFFFFF;
    }
</style>
@endpush


@section('content')

{!!Form::open(array('route'=>'pembelian.insert','id'=>'frmsave','method'=>'post'))!!}

<div class="row">
    <div class="col-xs-12">

        <div class="panel panel-default">

        <div class="panel-heading">
            Faktur Pembelian / Penerimaan
        </div>

        <div class="panel-body  table-responsive">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group col-lg-6">



                <div class="col-sm-12">
                {!! Form::label('kontak_id', 'Nama Supplier :', ['class' => 'control-label']) !!}
                <div class="input-group">
                {{ Form::hidden('kontak_id', null, array('id'=>'kontak_id', 'class' => 'form-control', 'required'=>'true')) }}
                {{ Form::text('nama_kontak', null, array('id'=>'nama_kontak','class' => 'form-control', 'placeholder'=>'Nama Supplier', 'required'=>'true')) }}
                <span class="input-group-btn">
                <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModalKontak" data-backdrop="static" data-keyboard="false">Cari</button>
                </span>
                </div>
                </div>

                <div class="col-sm-6">
                {!! Form::label('no_faktur', 'No Penerimaan :', ['class' => 'control-label']) !!}
                {!! Form::text('no_faktur', $invoice, ['style'=>'background: #eee','class' => 'form-control', 'readonly' => 'true']) !!}
                </div>


                <div class="col-sm-6">
                {!! Form::label('no_po', 'No Faktur :', ['class' => 'control-label']) !!}
                {!! Form::text('no_po', old('no_po'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>


                        <div class="col-sm-6">
                {!! Form::label('tanggal_faktur', 'Tanggal Faktur :', ['class' => 'control-label']) !!}
                <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" name="tanggal_faktur" id="tanggal_faktur" placeholder="Tanggal Faktur" value="01/03/2018">
                </div>
                </div>



                <div class="col-sm-6">
                {!! Form::label('tgl_jatuh_tempo', 'Tanggal Jatuh Tempo :', ['class' => 'control-label']) !!}
                <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" name="tgl_jatuh_tempo" id="tgl_jatuh_tempo" placeholder="Tanggal Faktur" value="01/03/2018">
                </div>
                </div>

                <div class="col-sm-6">
                {!! Form::label('penerima', 'Petugas Penerima :', ['class' => 'control-label']) !!}
                {!! Form::text('penerima', old('penerima'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>

                <div class="col-sm-6">
                {!! Form::label('keterangan', 'Keterangan :', ['class' => 'control-label']) !!}
                {!! Form::text('keterangan', old('keterangan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>

            </div>



                  <div class="form-group col-lg-6">

                <div class="col-sm-6">
                {!! Form::label('asal_penerimaan', 'Asal Penerimaan :', ['class' => 'control-label']) !!}
                <select class="form-control" name="asal_penerimaan">
                    <option value="" disabled="true" selected>-- Asal Penerimaan --</option>
                    <option value="Supplier">Supplier</option>
                    <option value="Transfer Cabang">Transfer Cabang</option>
                </select>
                </div>


                <!-- radio For Status -->
                <div class="col-sm-6">
                <label for="cara_pembelian" class="control-label">Metode Pembayaran :&nbsp;&nbsp;&nbsp;</label>

                  <!--
                  <input type="radio" id="cara_pembelian" class="flat" name="cara_pembelian" value="0" checked="true"> Cash &nbsp;&nbsp;&nbsp;
                  <input type="radio" id="cara_pembelian" class="flat" name="cara_pembelian" value="1"> Termin &nbsp;&nbsp;&nbsp;
                  <input type="radio" id="cara_pembelian" class="flat" name="cara_pembelian" value="2"> Lainnya &nbsp;&nbsp;&nbsp;
                  -->
                  <select class="form-control" name="cara_pembelian" onchange="lain2(this);">
                      <option value="" disabled="true" selected>Cara Pembayaran</option>
                      <option value="Cash">Cash</option>
                      <option value="Termin">Termin</option>
                      <option value="Lainnya">Lainnya</option>
                  </select>
                  <div id="ifYes" style="display: none;">
                  {{ Form::text('lainnya', null, array('id'=>'lainnya', 'class' => 'form-control', 'placeholder'=>'Keterangan Lainnya')) }}
                  </div>
                </div>


                <div class="col-sm-6">
                <?php
                    $id =  Auth::user()->gudang_id;
                    $gudang = App\Gudang::where('id', $id)->first();

                    $idd =  Auth::user()->departement_id;
                    $departement = App\Departement::where('id', $idd)->first();
                ?>
                {!! Form::label('gudang_masuk_id', 'Masuk Ke Gudang :', ['class' => 'control-label']) !!}
                {!! Form::hidden('gudang_masuk_id', $gudang->id, ['class' => 'form-control', 'readonly' => 'true']) !!}
                {!! Form::text('gudang_masuk_id2', $gudang->nama_gudang, ['class' => 'form-control', 'readonly' => 'true']) !!}
                </div>

                <div class="col-sm-6">
                {!! Form::label('departement_id', 'Departement/Asal Cabang :', ['class' => 'control-label']) !!}
                {!! Form::hidden('departement_id',  $departement->id, ['class' => 'form-control', 'readonly' => 'true']) !!}
                {!! Form::text('departement_id2',  $departement->nama_departement, ['class' => 'form-control', 'readonly' => 'true']) !!}
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

            <div class="form-group col-lg-12">
            <div>
                <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Cari Produk</button>
            </div>
            <br>

                <table class="table table-no-bordered"  id="item_table">
                    <thead style="background: #696969;">
                        <th class="warna-text">Kode</th>
                        <th class="warna-text">Deskripsi Produk</th>
                        <!--
                        <th class="warna-text">Kode Akun</th>
                        -->
                        <th class="warna-text" style="text-align: right;">Qty Beli&nbsp;</th>
                        <th class="warna-text">Satuan</th>
                        <th class="warna-text" style="text-align: right;">Harga</th>
                        <th class="warna-text" style="text-align: center;">Diskon</th>
                        <th class="warna-text" style="text-align: right;">Sub Total</th>
                        <th class="warna-text" style="text-align: center;">Pajak</th>
                        <th width="5%" style="text-align: center;background: #eee"><a href="#" class="addRow" title="Tambah Baris"><i class="glyphicon glyphicon-plus"></i></a></th>
                    </thead>
                    <tbody  style="background: #eee;">
                        <tr class="item">
                            <td width="13%">
                    <input type="hidden" name="produk_id[]" class="form-control calcEvent input-sm produk_id" id="produk_id">
                    <input type="text" name="kode_produk[]" class="form-control calcEvent input-sm kode_produk" id="kode_produk">
                    </td>
                            <td width="20%">
                             <div class="input-group">
                             <input type="text" name="nama_produk[]" class="form-control calcEvent input-sm nama_produk" id="nama_produk">
                             <span class="input-group-btn">
                             <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Cari</button>
                             </span>
                             </div>
                    </td>
                            <!--
                            <td width="10%"><input type="text" name="akun_id[]" class="form-control calcEvent input-sm akun_id"></td>-->
                            <td width="10%"><input type="text" name="qty[]" style="text-align: right;" class="form-control calcEvent input-sm  qty" id="qty"></td>
                            <!--
                            <td width="5%"><input type="text" name="qty_pesan[]" style="text-align: right;" class="form-control input-sm qty_pesan"></td> -->
                            <!--
                            <td width="8%">
                            <input type="text" name="uom_id[]" class="form-control uom_id">
                            </td>-->

                            <td width="12%">
                                <?php
                                 if(isset($_GET['uom_id2[]'])){
                                        $tryid = $_GET['uom_id2[]'];
                                    } else {
                                        $tryid = 'A, B, C';
                                        //$tryid = $_POST['uom_id2'];
                                 }
                                 $Number = (!empty($_POST['uom_id2']) ? $_POST['uom_id2'] : 'D, E, F');
                                ?>
                                <!--
                                <select class="form-control calcEvent input-sm uom_id" name="uom_id[]" id="uom_id">
                                <option value="0" selected="true" disabled="true">Satuan</option>
                                @foreach(explode(',', $Number) as $info)
                                    <option value="{{ $info }}">{{ $info }}</option>
                                @endforeach

                                </select>

                                <input type="hidden" name="uom_id2[]" class="form-control calcEvent input-sm uom_id2" id="uom_id2">
                                <select class="form-control calcEvent input-sm uom_id"  id="uom_id" name="uom_id[]" style="width: 120px">
                                    <option value="0" disabled="true">Pilih Satuan</option>
                                </select>
                                <div id="myDiv"></div>
                                -->
                                <select class="form-control calcEvent input-sm uom_id" name="uom_id[]" id="uom_id">
                                <option value="0" selected="true" disabled="true">Pilih Satuan</option>
                                @foreach($uoms_list as $key => $p)
                                <option value="{!!$key!!}">{!!$p!!}</option>
                                @endforeach
                                </select>

                            </td>

                            <td width="10%"><input type="text" name="harga[]" style="text-align: right;" class="form-control calcEvent input-sm  harga" id="harga"></td>
                            <td width="8%">
                            <input type="text" name="discount[]" style="text-align: center;" class="form-control calcEvent input-sm  discount" id="discount"></td>
                            <td width="10%"><input type="text" name="amount[]" style="text-align: right; background: #eee;" class="form-control input-sm  amount" readonly="true" id="amount"></td>
                            <td width="8%"><input type="text" name="pajak[]" style="text-align: center;"  class="form-control calcEvent input-sm  pajak" id="pajak"></td>
                            <!--
                            <td width="5%"><input  type="text" name="proyek2[]" class="form-control input-sm  proyek2"></td> -->
                            <td width="0%" hidden="true" ><input  type="hidden" name="proyek1[]" class="form-control calcEvent proyek1" id="proyek1"></td>

                            <td width="5%" style="text-align: center;">&nbsp;</td>
                        </tr>
                    </tbody>

              </table>

            </div>

            <div class="form-group col-lg-12">

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
                <a href="{{route('pembelian.index')}}" class="btn btn-primary">Batal</a>
                {!!Form::submit('Rekam', array('class'=>'btn btn-primary'))!!}
            </div>
        </div>

        <div class="form-group">
            <!--
            <input type="checkbox" name="is_cetak[]" value="Y" class="flat"> <label><b> Cetak</b></label>
            <input type="checkbox" name="is_tunai[]" value="Y" class="flat"> <label><b> Tunai</b></label>
            -->

            {!! Form::checkbox('is_cetak', 1, null, ['class' => 'flat']) !!}
            {!! Form::label('is_cetak', ' Cetak Faktur Pembelian/Penerimaan', ['class' => 'control-label']) !!}

            <!--
            {!! Form::checkbox('is_tunai', 1, null, ['class' => 'flat']) !!}
            {!! Form::label('is_tunai', ' Tunai', ['class' => 'control-label']) !!}


            <a href="javascript: void(0);" class="btn btn-large btn-info" id="bttn_add_product"><i class="fa fa-plus"></i> Add Item From Products</a>

            <div class="form-group">
                  <label for="nis" class="col-sm-2 control-label">NIS</label>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <input type="text" name="nis" id="nis" class="form-control" placeholder="NIS" >
                      <span class="input-group-btn">
                        <button type="button" class="btn bg-purple btn-flat" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Search</button>
                      </span>
                    </div>
                  </div>
                  <label for="nama" class="col-sm-1 control-label">Nama</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                    <input type="hidden" name="lbl_nama" id="lbl_nama">
                  </div>-->
            </div>






        <!--
        <div class="form-group">
          <label for="is_cetak" class="col-sm-3 control-label">Bebas SPP</label>
          <div class="col-sm-9">
            <input type="checkbox" name="is_cetak" value="1" class="flat-red"  >
          </div>
        </div>
        -->

</div>
{!! Form::close() !!}

<!-- Modal
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

                                    <table id="table_produk" class="table display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width:1%" hidden="false">
                                                    &nbsp;
                                                </th>
                                                <th style="width:15%">Kode Produk</th>
                                                <th style="width:35%">Nama Produk</th>
                                                <th style="width:25%;text-align: right;">Harga Jual Standar</th>
                                                <th style="width:24%;text-align: right;">Stok</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                  @foreach($product_list as $data)
                  <tr class="produk">
                    <?php
                    $id = $data->id;
                    ?>
                    <td width="1px" class="v-align-middle warna-text" hidden="false" >
                        {{ $data->id }}
                    </td>
                    <td class="v-align-middle">{{ $data->kode_produk }}</td>
                    <td class="v-align-middle">{{ $data->nama_produk }}</td>
                    <th class="v-align-middle" style="text-align: right;">{{ $data->harga_jual_satuan }}</th>
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

            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-success" id="btnx" value="Pilih Produk"/>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      -->
      <!-- /Modal <script type="text/javascript" src="{{ asset('js/kades.js')}}"> </script>-->




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
@stop



@push('javascripts')

    <!--
    <script type="text/javascript">
        $(document).ready(function () {
            //var url = "{{ asset('js/jqwidgets/sampledata/customers.txt') }}";
            //var url = "{{ route('pembelian.findSatuan') }}";

            data();
            // Will accure at every click
            $(document).click(function() { data(); });

        });

        function data(){
                var id = document.getElementById("produk_id").value;
                var idx = 10;

                //$('body').delegate('.jqwidgets','click', function(){
                var url = "http://127.0.0.1:8000/pembelian/satuan/"+id;
                //};

                // prepare the data
                var source =
                        {
                            datatype: "json",
                            datafields: [
                                { name: 0 }
                            ],
                            id: 'id',
                            url: url,
                            async: false
                        };

                var dataAdapter = new $.jqx.dataAdapter(source);
                var index = $.jqx.cookie.cookie("jqxDropDownList_jqxWidget");
                if (undefined == index) index = 0;
                $("#jqxWidget").jqxDropDownList({ selectedIndex: index, source: dataAdapter, displayMember: "0", valueMember: "0", width: 200, height: 30,});
               // $("#jqxWidget").jqxDropDownList({ source: dataAdapter, selectedIndex: index, width: 200, height: 30,});
              // subscribe to the select event.
              $("#jqxWidget").on('select', function (event) {
              // save the index in cookie.
              $.jqx.cookie.cookie("jqxDropDownList_jqxWidget", event.args.index);
            });
        }
    </script>
    -->

<!-- DataTables -->
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
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
            var taxValue    = parseFloat($(this).find("[id='pajak']").val()) > 0 ? parseFloat($(this).find("[id='pajak']").val()) : 0;
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

    <!--
    <script type="text/javascript">
    $(document).ready(function() {

        var table = $('#table_produk').DataTable({
            select: 'single'
        });

        document.getElementById('btnx').onclick = function()
        {
          let rows   = table.rows( { selected: true } );
          var result = table.cells( rows.nodes(), 0 ).data();
          //console.log(result);
          //alert(result[0]);
          var id = result[0];
          var dataId={'id':id};
          $.ajax({
                    type    : 'GET',
                    url     : '{!!URL::route('pembelian.findProduk')!!}',
                    dataType: 'json',
                    data    : dataId,
                    success : function(data){

                        var products = data.products;

                        for(var key in products) {
                            //noinspection JSJQueryEfficiency
                            var last_row = $('#item_table tr:last');
                            //var xxx = last_row.find('input[id=nama_produk]').val();

                            if (last_row.find('input[id=nama_produk]').val() !== '')
                            {
                                //addRow('item_table');
                                //var last_row = $('#item_table tr:last');
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
                            }
                            $('#myModal').modal('hide').reset();
                        }

                    }
              });



        };

      });
    </script>
    -->


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
            $("#tanggal_faktur").datepicker({
            format: 'dd/mm/yyyy',
            //todayHighlight: 'true'
            autoclose: true
        }).datepicker('setDate', new Date());
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
             $("#tanggal_kirim").datepicker({
            format: 'dd/mm/yyyy',
            //todayHighlight: 'true'
            autoclose: true
        }).datepicker('setDate', new Date());
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
             $("#tgl_jatuh_tempo").datepicker({
            format: 'dd/mm/yyyy',
            //todayHighlight: 'true'
            autoclose: true
        }).datepicker('setDate', new Date());
        });
    </script>

    <script type="text/javascript">

        /*
        $('tbody').delegate('.uom_id','click',function(){
            var tr =$(this).parent().parent();
            var id = tr.find('.produk_id').val();
            //var kontak_id = document.getElementById("kontak_id").value;
            //alert(id);
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('pembelian.findSatuan')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    if (undefined == data.uom_id) data.uom_id = 'Pcs';
                    alert(data.uom_id);

                    tr.find('.uom_id2').val(data.uom_id);
                }
            });

        });
        */

        $('tbody tr').delegate('.qty','click',function(){

            //var kontak_id = document.getElementById("kontak_id").value;
            //alert(id);
            var myDiv = document.getElementById("myDiv");
                //var array = ["Volvo","Saab","Mercades","Audi"];

                var tr = $(this).parent().parent();
                var id = tr.find('.produk_id').val();

                //alert(id);
                var dataId = {
                           'id':id
                        };

                $.ajax({
                type    : 'GET',
                url     : '{{ url("pembelian/satuanx") }}/'+id,
                dataType: 'json',
                array    : dataId,

                success:function(array){
                    //Create and append select list
                    var selectList = document.createElement("select");
                    selectList.setAttribute("id", "uom_id");
                    selectList.setAttribute("name", "uom_id[]");
                    electList.setAttribute("class", "form-control uom_id");
                    myDiv.appendChild(selectList);

                    //Create and append the options
                    for (var i = 0; i < array.length; i++) {
                        //var option = document.createElement("option");
                        //option.setAttribute("value", array[i]);
                        //option.text = array[i];
                        //selectList.appendChild(option);
                        tr.find('.uom_id').option().setAttribute("value", array[i]);
                        tr.find('.uom_id').option.text(array[i]);
                    }
                    }
                });

        });

        $('tbody').delegate('.nama_produk','change',function(){
            var tr=$(this).parent().parent();
            var id = tr.find('.nama_produk').val();
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('pembelian.findKodeProduk')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    //alert(data.kode_produk);
                    tr.find('.kode_produk').val(data.kode_produk);
                }
            });
        });

        $('tbody tr').delegate('.qty','click change paste keyup',function(){

                var tr = $(this).parent().parent();
                //var tr = $(this).parents('table').parents('tbody').attr('id');
                var id = tr.find('.produk_id').val();

                var x = tr.find('.uom_id');//

                let dropdown = document.getElementById('uom_id');
                dropdown.length = 0;

                let defaultOption = document.createElement('option');
                defaultOption.text = 'Pilih Satuan';

                dropdown.add(defaultOption);
                dropdown.selectedIndex = 0;

                const url = '{{ url("pembelian/satuan") }}/'+id;

                const request = new XMLHttpRequest();
                request.open('GET', url, true);

                request.onload = function() {
                  //var tr = $(this).parent().parent();
                  if (request.status === 200) {
                    const data = JSON.parse(request.responseText);
                    let option;
                    for (let i = 0; i < data.length; i++) {
                      option = document.createElement('option');
                      option.text = data[i];//.name;
                      option.value = data[i];//.abbreviation;
                      dropdown.add(option);
                      //tr.find('.uom_id').add(option);
                    }
                   } else {
                    // Reached the server, but it returned an error
                  }
                }

                request.onerror = function() {
                  console.error('An error occurred fetching the JSON from ' + url);
                };
                request.send();

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
                url     : '{!!URL::route('pembelian.findPrice')!!}',
                dataType: 'json',
                data    : dataId,

                success:function(data){

                    tr.find('.harga').val(data.harga_jual_satuan);
                }
            });
        });

        $('tbody').delegate('.nama_produk','click change paste keyup',function(){
            //alert('sadsad');
            var tr = $(this).parent().parent();
            tr.find('.qty').focus();
        });

        $('tbody').delegate('.qty,.harga,.discount', 'click change paste keyup',function(){
            //alert('sadsad');

            var tr = $(this).parent().parent();
            var qty = tr.find('.qty').val();
            var harga = tr.find('.harga').val();
            var discount = tr.find('.discount').val();
            var amount = (qty * harga) - (qty * harga * discount)/100;
            tr.find('.amount').val(amount);

            total();
            totalpajak();
            totalsetelahpajak();
            //calcTotals();
        });

        $('tbody').delegate('.qty,.harga,.discount,.pajak', 'click change paste keyup',function(){
            //alert('pajak : ' totalpajak());
            var tr =$(this).parent().parent();
            var amount = tr.find('.amount').val();
            var pajak  = tr.find('.pajak').val();

            var pajakrp = amount * (pajak/100);
            tr.find('.proyek1').val(pajakrp);
            //alert(pajakrp);

            total();
            //total2();
            totalpajak();
            totalsetelahpajak();
            //calcTotals();
        });

        $('body').delegate('.qty,.harga,.discount,.pajak,.biaya_lain','click change paste keyup', function(){

            var x = document.getElementById("totalsetelahpajak2").value;
            var biaya_lain = document.getElementById("biaya_lain").value;
            total22 = parseInt(x) + parseFloat(biaya_lain);

            $('.totalsetelahpajak').val("Rp. "+total22.formatMoney(2,'.',','));
            $('.totalsetelahpajak3').val(total22);

        });

        $('body').delegate('.qty,.harga,.discount,.pajak,.biaya_lain,.uang_muka','click change paste keyup', function(){

            var m = document.getElementById("totalsetelahpajak3").value;
            var uang_muka = document.getElementById("uang_muka").value;

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
                var proyek1 = $(this).val()-0 > 0 ? $(this).val()-0 : 0;
                totalpajak += proyek1 ;
            })

            $('.totalpajak').html("Rp. "+totalpajak.formatMoney(2,'.',','));
            $('.totalpajak').val("Rp. "+totalpajak.formatMoney(2,'.',','));
        };

        function totalsetelahpajak(){
            //var total = total();
            var totalsetelahpajak = 0;

            var totalpajak =0;
            $('.proyek1').each(function(i,e){
                var proyek1 = $(this).val()-0;
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
                            '<td width="8%"><input type="hidden" name="produk_id[]" class="form-control calcEvent input-sm produk_id" id="produk_id"><input type="text" name="kode_produk[]" class="form-control calcEvent input-sm kode_produk" id="kode_produk"></td>'+
                            '<td width="20%">'+
                             '<div class="input-group">'+
                             '<input type="text" name="nama_produk[]" class="form-control calcEvent input-sm nama_produk" id="nama_produk">'+
                             '<span class="input-group-btn">'+
                             '<button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Cari</button>'+
                             '</span>'+
                             '</div>'+
                            '</td>     '+
                            '<!--<td width="10%"><input type="text" name="akun_id[]" class="form-control calcEvent input-sm akun_id" id="akun_id"></td>-->'+
                            '<td width="5%"><input type="text" name="qty[]" style="text-align: right;" class="form-control input-sm qty" id="qty"></td>'+
                            '<!--<td width="5%"><input type="text" name="qty_pesan[]" style="text-align: right;" class="form-control calcEvent qty_pesan"></td>-->'+
                            '<td width="15%">'+
                                '<input type="hidden" name="uom_id2[]" class="form-control calcEvent input-sm uom_id2" id="uom_id2">'+
                                '<select class="form-control calcEvent input-sm uom_id" name="uom_id[]" id="uom_id">'+
                                '<option value="0" selected="true" disabled="true">Pilih Satuan</option>'+
                                '@foreach($uoms_list as $key => $p)'+
                                '<option value="{!!$key!!}">{!!$p!!}</option>'+
                                '@endforeach'+
                                '</select>'+
                            '</td>'+
                            '<td width="10%"><input type="text" name="harga[]" style="text-align: right;" class="form-control calcEvent input-sm harga" id="harga"></td>'+
                            '<td width="5%"><input type="text" name="discount[]" style="text-align: center;" class="form-control calcEvent input-sm discount" id="discount"></td>'+
                            '<td width="10%"><input type="text" name="amount[]" style="text-align: right; background: #eee;" class="form-control calcEvent input-sm amount" id="amount" readonly="true"></td>'+
                            '<td width="6%"><input type="text" name="pajak[]" style="text-align: center;"  class="form-control calcEvent input-sm pajak" id="pajak"></td>'+
                            '<!--<td width="5%"><input type="text" name="proyek2[]" class="form-control calcEvent input-sm proyek2"></td>-->'+
                            '<td width="0%" hidden="true" ><input type="hidden" name="proyek1[]" class="form-control calcEvent input-sm proyek1" id="proyek1"></td>'+
                            '<td width="5%" style="text-align:center;"><a href="#" class="btn btn-xs btn-danger remove"><i class="glyphicon glyphicon-minus"></i></a></td>'+
                        '</tr>';
            $('#item_table').append(tr);
        };

        $(document).on('click', '.remove', function() {
        //$('.remove').live('click', function(){
            var l=$('tbody tr').length;
            if (l==1)
            {
                alert('Anda tidak bisa menghapus baris terakhir !');
            }else{
                $(this).parent().parent().remove();
            total();
            //total2();
            totalpajak();
            totalsetelahpajak();
            }
        });

    </script>

    <script>
    function lain2(that) {
        if (that.value == "Lainnya") {
            //alert("check");
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
        document.getElementById("lainnya").focus();
    }
    </script>


@endpush
