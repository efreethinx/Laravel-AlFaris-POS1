@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.klasifikasi.title')
        <small>Add</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('klasifikasi')}}"> @lang('global.klasifikasi.title')</a></li>
        <li class="active">@lang('global.app_create')</li>
      </ol>    
@stop

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['klasifikasi.store'],'class' => 'form-horizontal']) !!}

<div class="row">

<div class="col-xs-12">

   <div class="box box-success">

        <div class="box-header with-border">
            @lang('global.app_create')
        </div>
        
        <div class="box-body">

                <div class="form-group">
                    {!! Form::label('klasifikasi', 'Nama  Klasifikasi *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('klasifikasi', old('klasifikasi'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    @if($errors->has('kode_klasifikasi'))
                     {{ $errors->first('kode_klasifikasi') }}
                    @endif

                    <div class="col-sm-4">
                    <table class="table table-bordered table-conseded">
                        <tr>
                            <td style="width: 10px">
                                <!--
                                {!! Form::checkbox('is_container', old('is_container'),['class' => 'flat']) !!}
                                
                                <input type="checkbox" name="is_container[]" class="flat">
                                -->
                                {!! Form::checkbox('is_container', 'Y') !!}
                            </td>
                            <td>
                                {!! Form::label('is_container', 'Berupa Container') !!}
                            </td>
                        </tr>
                    </table>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('nama_klasifikasi', 'Nama klasifikasi *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nama_klasifikasi', old('nama_klasifikasi'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_klasifikasi'))
                        <p class="help-block">
                            {{ $errors->first('nama_klasifikasi') }}
                        </p>
                    @endif
                </div>
                
                <div class="form-group"> 
                {!! Form::label('dimensi_container', 'Dimensi Container', ['class' => 'col-sm-2 control-label']) !!}
                  <div class="col-sm-1">
                  <div class="input-group spinner">
                    <input name="dimensi_container" id="dimensi_container" type="text" class="form-control" value="20" >
                    <div class="input-group-btn-vertical">
                      <button id="btn_up" class="btn btn-default" type="button" ><i class="fa fa-caret-up"></i></button>
                      <button id="btn_down" class="btn btn-default" type="button" ><i class="fa fa-caret-down"></i></button>
                    </div>
                  </div>
                  </div>                  
                </div>
                                
                
                <div class="form-group">
                    {!! Form::label('alamat', 'Alamat', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::textarea('alamat', old('alamat'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('alamat'))
                        <p class="help-block">
                            {{ $errors->first('alamat') }}
                        </p>
                    @endif
                </div>
                   
                <div class="form-group">

                    {!! Form::label('kota', 'Kota', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kota', old('kota'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    {!! Form::label('kode_pos', 'Kode Pos', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kode_pos', old('kode_pos'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div>               
                
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
                
                <div class="form-group">
                    {!! Form::label('kategori_klasifikasi', '.', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    <table class="table table-bordered table-conseded">
                        <tr>
                            <td style="width: 10px">
                            <!--
                                {!! Form::checkbox('kategori_klasifikasi', old('kategori_klasifikasi'),['class' => 'flat']) !!}
                                -->
                                {!! Form::checkbox('is_container', 'Y') !!}
                            </td>
                            <td>
                                {!! Form::label('kategori_klasifikasi', 'klasifikasi Standar (Default)') !!}
                            </td>
                        </tr>
                    </table>
                    </div>
                </div>
            
                <div class="form-group">
                    {!! Form::label('is_active', '.', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    <table class="table table-bordered table-conseded">
                        <tr>
                            <td style="width: 10px">
                                <!--
                                {!! Form::checkbox('is_active', old('is_active'),['class' => 'flat']) !!}
                                -->

                                {!! Form::checkbox('is_container', 'Y') !!}
                                
                            </td>
                            <td>
                                {!! Form::label('is_active', 'Tidak Aktif') !!}
                            </td>
                        </tr>
                    </table>
                    </div>
                </div>

        </div>

        <div class="box-footer">
            <div class="btn-group pull-right">
            <a href="{{URL('klasifikasi')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
            <button type="submit" class="btn btn-success" id="btnSubmit" style="margin-left: 5px;">
            <i class="fa fa-check fa-fw"></i> Save</button>
            </div>
        </div>

    </div>

    </div>
</div>

    {!! Form::close() !!}

@stop

