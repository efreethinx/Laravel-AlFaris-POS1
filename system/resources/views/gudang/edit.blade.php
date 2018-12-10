@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.gudang.title')
        <small>Update</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('gudang')}}"> @lang('global.gudang.title')</a></li>
        <li class="active">@lang('global.app_update')</li>
      </ol>    
@stop

@section('content')
    
    {!! Form::model($gudang, ['method' => 'PUT', 'route' => ['gudang.update', $gudang->id],'class' => 'form-horizontal']) !!}


<div class="row">

<div class="col-xs-12">

    <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body table-responsive">
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
                            </td>
                            <td>
                                {!! Form::label('is_container', 'Berupa Container') !!}
                            </td>
                        </tr>
                    </table>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('nama_gudang', 'Nama Gudang *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nama_gudang', old('nama_gudang'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_gudang'))
                        <p class="help-block">
                            {{ $errors->first('nama_gudang') }}
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
                    {!! Form::label('kategori_gudang', '.', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    <table class="table table-bordered table-conseded">
                        <tr>
                            <td style="width: 10px">
                                {!! Form::checkbox('kategori_gudang', old('kategori_gudang'),['class' => 'flat']) !!}
                            </td>
                            <td>
                                {!! Form::label('kategori_gudang', 'Gudang Standar (Default)') !!}
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
                                
                                {!! Form::checkbox('is_active', old('is_active'),['class' => 'flat']) !!}
                                
                            </td>
                            <td>
                                {!! Form::label('is_active', 'Tidak Aktif') !!}
                            </td>
                        </tr>
                    </table>
                    </div>
                </div>


                <div class="btn-group pull-right">
            <a href="{{URL('gudang')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
            <button type="submit" class="btn btn-warning" id="btnSubmit" style="margin-left: 5px;">
            <i class="fa fa-check fa-refresh"></i> Update</button>
            </div>
            
        </div>

        

    </div>

    <div class="box-footer">
            
        </div>

    </div>
</div>

    {!! Form::close() !!}
@stop

