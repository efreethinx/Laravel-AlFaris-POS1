@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.akun.title')
        <small>Update</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('akun')}}"> @lang('global.akun.title')</a></li>
        <li class="active">@lang('global.app_update')</li>
      </ol>    
@stop

@section('content')
    
    {!! Form::model($akun, ['method' => 'PUT', 'route' => ['akun.update', $akun->id],'class' => 'form-horizontal']) !!}


<div class="row">

<div class="col-xs-12">

    <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_edit') Akun
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
                  <label for="subklasifikasi" class="col-sm-2 control-label">Subklasifikasi</label>
                  <div class="col-sm-3">
                    <div class="input-group">
                      {!! Form::select('subklasifikasi_id', $subklasifikasi, Input::old('subklasifikasi_id'), ['class' => 'form-control', 'placeholder' => '-- Subklasifikasi --']) !!}
                      <span class="input-group-btn">
                        <!--
                        <button type="button" class="btn bg-success btn-flat" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-keyboard="false"> ... </button>
                        -->
                        <a href="{{route('subklasifikasi.create')}}" class="btn btn-primary"> ... </a>
                      </span>
                    </div>
                  </div>
                  <!--
                  <label for="nama" class="col-sm-1 control-label">Nama</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                    <input type="hidden" name="lbl_nama" id="lbl_nama">
                  </div>
                  -->
                </div>

                <!--
                <div class="form-group">
                    {!! Form::label('subklasifikasi', 'Subklasifikasi', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::select('subklasifikasi', $subklasifikasi, old('subklasifikasi'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    @if($errors->has('subklasifikasi'))
                     {{ $errors->first('subklasifikasi') }}
                    @endif
                </div>
                -->
                
                <div class="form-group">
                    {!! Form::label('kode_akun', 'Kode', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kode_akun', old('kode_akun'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    @if($errors->has('kode_akun'))
                     {{ $errors->first('kode_akun') }}
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('nama_akun', 'Nama', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nama_akun', old('nama_akun'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_akun'))
                        <p class="help-block">
                            {{ $errors->first('nama_akun') }}
                        </p>
                    @endif
                </div>
                
                <div class="form-group">
                    {!! Form::label('nama_alias', 'Nama Alias ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nama_alias', old('nama_alias'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}                    
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_alias'))
                        <p class="help-block">
                            {{ $errors->first('nama_alias') }}
                        </p>
                    @endif
                </div>
                               
                <div class="form-group">                             

                    {!! Form::label('kas_bank', '.', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    <table class="table table-bordered table-conseded">
                        <tr>
                            <td style="width: 10px">
                            <!--
                                {!! Form::checkbox('kas_bank', old('kas_bank'),['class' => 'flat']) !!}
                                -->
                                {!! Form::checkbox('kas_bank', 'Y') !!}
                            </td>
                            <td>
                                {!! Form::label('kas_bank', 'Kas/Bank') !!}
                            </td>
                        </tr>
                    </table>
                    </div>

                    <div class="col-sm-4">
                    <table class="table table-bordered table-conseded">
                        <tr>
                            <td style="width: 10px">
                                <!--
                                {!! Form::checkbox('is_active', old('is_active'),['class' => 'flat']) !!}
                                
                                <input type="checkbox" name="is_active[]" class="flat">
                                -->
                                {!! Form::checkbox('is_active', 'Y') !!}
                            </td>
                            <td>
                                {!! Form::label('is_active', 'Tidak Aktif') !!}
                            </td>
                        </tr>
                    </table>
                </div>
                </div>
            
                <div class="form-group">

                    {!! Form::label('kurs', 'Kurs', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    {!! Form::text('kurs', old('kurs'), ['class' => 'form-control', 'placeholder' => 'IDR']) !!}
                    </div>
                    
                    {!! Form::label('departement_id', 'Departement', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::select('departement_id', $departement, old('departement_id'), ['class' => 'form-control', 'placeholder' => '-- Departement --']) !!}
                    </div>
                    
                </div>  



                <div class="btn-group pull-right">
            <a href="{{URL('akun')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
            <button type="submit" class="btn btn-warning" id="btnSubmit" style="margin-left: 5px;">
            <i class="fa fa-check fa-refresh"></i> Update</button>
            
        </div>

        

    </div>

    <div class="box-footer">
            
            </div>
        </div>

    </div>
</div>

    {!! Form::close() !!}
@stop

