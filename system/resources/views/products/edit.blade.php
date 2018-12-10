@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.products.title')
        <small>Update</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('products')}}"><i class="fa fa-dashboard"></i> @lang('global.products.title')</a></li>
        <li class="active">@lang('global.app_update')</li>
      </ol>    
@stop

@section('content')
    
    {!! Form::model($products, ['method' => 'PUT', 'route' => ['products.update', $products->id],'class' => 'form-horizontal']) !!}

<div class="row">

<div class="col-xs-12">

    <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

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
                    {{ Form::select('uom_id[]', $tags, $selected, array('id'=>'multiselect', 'class' => 'form-control', 'multiple'=>'multiple')) }}

                    

                    

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

                {{ Form::radio('is_active', '0', old('is_active')) }} &nbsp; Aktif </br>
                {{ Form::radio('is_active', '1', old('is_active')) }} &nbsp; Tidak Aktif
                -->
                
                <input type="radio" class="flat" id="is_active" name="is_active"  value="0" {{ $products->is_active == '0' ? 'checked' : '' }} /> &nbsp; Aktif </br>
                <input type="radio" value="1" id="is_active" class="flat" name="is_active" {{ $products->is_active == '1' ? 'checked' : '' }} />  &nbsp; Tidak Aktif
                
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
                  <button type="submit" class="btn btn-warning" id="btnSubmit" style="margin-left: 5px;">
                  <i class="fa fa-refresh fa-fw"></i> Update</button>
                  </div>
                  </div>
                </div>

                </div>

       

    </div>

    <div class="panel-footer">
            <p>&nbsp;</p>
    </div>


    </div>
</div>

{!! Form::close() !!}
@stop

@push('javascripts')
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


<style type="text/css">
    .multiselect-container {
        width: 100% !important;
    }
</style>
-->
@endpush

