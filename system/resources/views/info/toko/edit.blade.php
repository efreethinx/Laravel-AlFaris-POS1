@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.gudang.title')
        <small>Add</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('gudang')}}"> @lang('global.gudang.title')</a></li>
        <li class="active">@lang('global.app_create')</li>
      </ol>    
@stop

@section('content')
    
    {!! Form::model($gudang, ['method' => 'PUT', 'route' => ['toko.update', $gudang->id],'class' => 'form-horizontal']) !!}

<div class="row">

<div class="col-xs-12">

    <div class="panel panel-default">
        
        <div class="panel-heading">
            Buat Informasi Toko
        </div>

        <div class="panel-body table-responsive">

                <!--
                <div class="form-group">
                    {!! Form::label('kode_gudang', 'Kode  Gudang *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kode_gudang', old('kode_gudang'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    @if($errors->has('kode_gudang'))
                     {{ $errors->first('kode_gudang') }}
                    @endif

                    <div class="col-sm-4">
                    <table class="table table-bordered table-conseded">
                        <tr>
                            <td style="width: 10px">
                              
                                {!! Form::checkbox('is_container', old('is_container'),['class' => 'flat']) !!}
                                
                                <input type="checkbox" name="is_container[]" class="flat">
                              
                                {!! Form::checkbox('is_container', 'Y') !!}
                            </td>
                            <td>
                                {!! Form::label('is_container', 'Berupa Container') !!}
                            </td>
                        </tr>
                    </table>
                    </div>
                </div>

                -->

                <div class="form-group">
                    {!! Form::label('nama_toko', 'Nama Toko *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nama_toko', old('nama_toko'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_toko'))
                        <p class="help-block">
                            {{ $errors->first('nama_toko') }}
                        </p>
                    @endif
                </div>
                
                
                <!--
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
                  </div>
                </div>
                -->

                <!--
                <div class="form-group">
                    {!! Form::label('dimensi_container', 'Dimensi Container', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    {!! Form::number( 'dimensi_container', '20', old('dimensi_container'), ['class' => 'text-center form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('dimensi_container'))
                        <p class="help-block">
                            {{ $errors->first('dimensi_container') }}
                        </p>
                    @endif
                </div>
                -->
                                
                
                <div class="form-group">
                    {!! Form::label('alamat_toko', 'Alamat', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::textarea('alamat_toko', old('alamat_toko'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('alamat_toko'))
                        <p class="help-block">
                            {{ $errors->first('alamat_toko') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">

                    {!! Form::label('desa_toko', 'Desa', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('desa_toko', old('desa_toko'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    {!! Form::label('kecamatan_toko', 'Kecamatan', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kecamatan_toko', old('kecamatan_toko'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div>   
                   
                <div class="form-group">

                    {!! Form::label('kota_toko', 'Kota', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kota_toko', old('kota_toko'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    {!! Form::label('provinsi_toko', 'Provinsi', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('provinsi_toko', old('provinsi_toko'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div>

                <div class="form-group">

                    {!! Form::label('kode_pos_toko', 'Kode Pos', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kode_pos_toko', old('kode_pos_toko'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div>               
                
                <div class="form-group">

                    {!! Form::label('hp_toko', 'Telepon', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('hp_toko', old('hp_toko'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div>   

                <!--
                <div class="form-group">
                    {!! Form::label('negara', 'Negara', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('negara', old('negara'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('negara'))
                        <p class="help-block">
                            {{ $errors->first('negara') }}
                        </p>
                    @endif
                </div>
                
                <div class="form-group">
                    {!! Form::label('keterangan', 'Keterangan', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::textarea('keterangan', old('keterangan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('keterangan'))
                        <p class="help-block">
                            {{ $errors->first('keterangan') }}
                        </p>
                    @endif
                </div>
                -->
                
                <!--
                <div class="form-group">
                    {!! Form::label('kategori_gudang', '.', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    <table class="table table-bordered table-conseded">
                        <tr>
                            <td style="width: 10px">
                            
                                {!! Form::checkbox('kategori_gudang', old('kategori_gudang'),['class' => 'flat']) !!}
                                
                                {!! Form::checkbox('kategori_gudang', 'Y') !!}
                            </td>
                            <td>
                                {!! Form::label('kategori_gudang', 'Gudang Standar (Default)') !!}
                            </td>
                        </tr>
                    </table>
                    </div>
                </div>

                -->
            
                
                <!--
                <div class="form-group">
                    {!! Form::label('is_active', '.', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    <table class="table table-bordered table-conseded">
                        <tr>
                            <td style="width: 10px">
                                
                                {!! Form::checkbox('is_active', old('is_active'),['class' => 'flat']) !!}
                                

                                {!! Form::checkbox('is_active', 'Y') !!}

                                
                                
                            </td>
                            <td>
                                {!! Form::label('is_active', 'Tidak Aktif') !!}
                            </td>
                        </tr>
                    </table>
                    </div>
                </div>
                -->


        <div class="btn-group pull-right">
            <a href="{{URL('info/toko')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
            <button type="submit" class="btn btn-success" id="btnSubmit" style="margin-left: 5px;">
            <i class="fa fa-check fa-fw"></i> Save</button>
            </div>
        </div>

        

    </div>

    <div class="box-footer">
            
        </div>

    </div>
</div>

    {!! Form::close() !!}

@stop

