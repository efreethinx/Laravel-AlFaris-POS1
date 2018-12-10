@extends('layouts.app')



@section('content-header')
      <h1>
        @lang('global.products.title')
        <small>Add</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('products')}}"> @lang('global.products.title')</a></li>
        <li class="active">@lang('global.app_create')</li>
      </ol>    
@stop

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['products.store'],'class' => 'form-horizontal']) !!}

<div class="row">

<div class="col-xs-12">

    <div class="panel panel-default">
        
        <div class="panel-heading">
            Input Data Produk Baru
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
        <div class="panel-body table-responsive">

                <div class="form-group">
                    {!! Form::label('nama_produk', 'Nama Produk *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nama_produk', old('nama_produk'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_produk'))
                        <p class="help-block">
                            {{ $errors->first('nama_produk') }}
                        </p>
                    @endif
                </div>                

                <div class="form-group">
                  {!! Form::label('kode_produk', 'Kode Produk *', ['class' => 'col-sm-2 control-label']) !!}
                  <div class="col-sm-3">
                    {!! Form::text('kode_produk', old('kode_produk'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                  </div>
                  

                    {!! Form::label('uom_id', 'Satuan Dasar', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                    {{ Form::select('uom_id[]', $uoms, old('uom_id'), array('id'=>'multiselect', 'class' => 'form-control', 'multiple'=>'multiple')) }}
                    </div>
                    
                </div>

                <div class="form-group">
                    {!! Form::label('kategori_id', 'Kelompok Produk', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                    {!! Form::select('kategori_id', $kategori, old('kategori_id'), ['class' => 'form-control', 'placeholder' => '-- Pilih Kelompok Produk --']) !!}
                    </div>
                    
                  <!--  
                  {!! Form::label('pajak_masuk', 'Pajak Masukan', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                    {!! Form::text('pajak_masuk', old('pajak_masuk'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                  -->
                    
                </div>

                <!--
                <div class="form-group">
                  {!! Form::label('kode_alias', 'Kode Alias', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                    {!! Form::text('kode_alias', old('kode_alias'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    

                  {!! Form::label('pajak_keluar', 'Pajak Keluaran', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-3">
                    {!! Form::text('pajak_keluar', old('pajak_keluar'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    
                </div>


                <div class="form-group">
                    {!! Form::label('nama_alias', 'Nama Alias', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nama_alias', old('nama_alias'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_alias'))
                        <p class="help-block">
                            {{ $errors->first('nama_alias') }}
                        </p>
                    @endif
                </div>
                -->

                <div class="item form-group">
                    {!! Form::label('stok_min', 'Minimum Stok', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                    {!! Form::text('stok_min', old('stok_min'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('stok_min'))
                        <p class="help-block">
                            {{ $errors->first('stok_min') }}
                        </p>
                    @endif
                </div>
                
                <div class="item form-group">
                    {!! Form::label('harga_beli_satuan', 'Harga Beli Satuan', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                    {!! Form::text('harga_beli_satuan', old('harga_beli_satuan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('harga_beli_satuan'))
                        <p class="help-block">
                            {{ $errors->first('harga_beli_satuan') }}
                        </p>
                    @endif
                </div>

                <div class="item form-group">
                    {!! Form::label('harga_jual_satuan', 'Harga Jual Satuan', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-1">
                    {!! Form::text('pct_harga', old('pct_harga'), ['class' => 'form-control calcEvent', 'placeholder' => '']) !!}
                    </div>
                    <div class="col-sm-7">
                    {!! Form::text('harga_jual_satuan', old('harga_jual_satuan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('harga_jual_satuan'))
                        <p class="help-block">
                            {{ $errors->first('harga_jual_satuan') }}
                        </p>
                    @endif
                </div>
                
                <div class="form-group">
                    {!! Form::label('supplier_id', 'Supplier Utama', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-6">
                    {!! Form::select('supplier_id', $supplier, old('supplier_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('supplier_id'))
                        <p class="help-block">
                            {{ $errors->first('supplier_id') }}
                        </p>
                    @endif
                </div>
                
                <!--
                <label class="col-sm-2 control-label lbl-menu">Kondisi </label>
                <div class="col-sm-5">
                       <table class="table table-bordered table-condensed">                             
                        <tr>
                          <td style="width: 10px">
                              <label>
                                {!! Form::checkbox('is_active', 'Y', ['class' => 'flat']) !!}
                              </label>                            
                          </td>
                          <td>Tidak Aktif</td>
                        </tr>                          
                                              
                        <tr>
                          <td style="width: 10px">
                              <label>
                                {!! Form::checkbox('is_jasa', 'Y', ['class' => 'flat']) !!}
                              </label>                            
                          </td>
                          <td>Jasa</td>
                        </tr>                          
                       </table>
                </div>
                -->

                <div class="form-group">
                {!! Form::label('is_active', 'Status', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                <!--
                {!! Form::checkbox('is_cetak', 1, null, ['class' => 'flat']) !!}                
                {!! Form::label('is_cetak', ' Cetak', ['class' => 'control-label']) !!}
                -->
                {{ Form::radio('is_active', '0', true, ['class' => 'flat']) }} &nbsp; Aktif </br>
                {{ Form::radio('is_active', '1', null, ['class' => 'flat']) }} &nbsp; Tidak Aktif
                </div>
                </div>

                <!--
                <div class="form-group">
                {!! Form::label('is_jasa', '&nbsp;', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                {!! Form::checkbox('is_jasa', 1, null, ['class' => 'flat']) !!}                
                {!! Form::label('is_jasa', ' Jasa', ['class' => 'control-label']) !!}
                </div>
                </div>
                -->
                        
            <div class="form-group">
                  {!! Form::label('is_active', '&nbsp;', ['class' => 'col-sm-2 control-label']) !!}
                  <div class="col-sm-10">
                  <div class="btn-group pull-left">
                  <a href="{{URL('products')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
                  <button type="submit" class="btn btn-success" id="btnSubmit" style="margin-left: 5px;">
                  <i class="fa fa-check fa-fw"></i> Save</button>
                  </div>
                  </div>
                </div>

            </div>   
                
            
        
        <div class="panel-footer"> 
        <p>&nbsp;</p>
            
        </div>

    </div>

    </div>
</div>

{!! Form::close() !!}

@stop

@push('javascripts')

<script type="text/javascript">

    $( document ).on("click change paste keyup", ".calcEvent", function() {
        //alert('test');
        calcTotals();
    });

    function calcTotals(){

        var harga_beli    = parseInt($("[name='harga_beli_satuan']").val());
        var pct     = parseFloat($("[name='pct_harga']").val()) > 0 ? parseFloat($("[name='pct_harga']").val()) : 0;
        
        var pct_amount    = (pct/100) * harga_beli;
        var harga_jual    = harga_beli + pct_amount;

        //total           += parseFloat(subTotal+totalTax-discount_amount);
        //amountDue       += parseFloat(subTotal+totalTax-discount_amount-paid);
        //alert(harga_beli+'  '+pct+'  '+pct_amount+'  '+harga_jual);
        $('#harga_jual_satuan').val( harga_jual);
        //$( '#taxTotal' ).text( totalTax.toFixed(2) );
        //$( '#grandTotal' ).text( total.toFixed(2) );
        //$( '#amountDue' ).text( amountDue.toFixed(2) );
    }
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" type="text/css"/>


<script type="text/javascript">
    $(document).ready(function() {
        $('#multiselect').multiselect({
            //buttonWidth: '100%'
        });
    });
</script>

<!--
<script type="text/javascript">    
// Material Select Initialization
$(document).ready(function() {
    $('.mdb-select').material_select();
});
            
</script>
-->

<!--
<style type="text/css">
    .multiselect-container {
        width: 100% !important;
    }
</style>
-->
@endpush


