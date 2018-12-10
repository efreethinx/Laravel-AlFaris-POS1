@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.departements.title')
        <small>Add</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('departements')}}"><i class="fa fa-dashboard"></i> @lang('global.departements.title')</a></li>
        <li class="active">@lang('global.app_create')</li>
      </ol>    
@stop

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['departements.store'],'class' => 'form-horizontal']) !!}

<div class="row">

<div class="col-xs-12">

    <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_create') Tambah Departement
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
                    {!! Form::label('kode_departement', 'Kode  *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('kode_departement', old('kode_departement'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('kode_departement'))
                        <p class="help-block">
                            {{ $errors->first('kode_departement') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('nama_departement', 'Nama *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nama_departement', old('nama_departement'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_departement'))
                        <p class="help-block">
                            {{ $errors->first('nama_departement') }}
                        </p>
                    @endif
                </div>
                
                
                <div class="form-group">
                    {!! Form::label('sub_departement', 'Sub Departement', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('sub_departement', old('sub_departement'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('sub_departement'))
                        <p class="help-block">
                            {{ $errors->first('sub_departement') }}
                        </p>
                    @endif
                </div>
                
                
                <div class="form-group">
                    {!! Form::label('manager', 'Penanggung Jawab *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('manager', old('manager'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('manager'))
                        <p class="help-block">
                            {{ $errors->first('manager') }}
                        </p>
                    @endif
                </div>
                
                
                <div class="form-group">
                    {!! Form::label('bidang', 'Bidang', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('bidang', old('bidang'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('bidang'))
                        <p class="help-block">
                            {{ $errors->first('bidang') }}
                        </p>
                    @endif
                </div>
                
                <div class="form-group">
                    {!! Form::label('catatan', 'Catatan', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::textarea('catatan', old('catatan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('catatan'))
                        <p class="help-block">
                            {{ $errors->first('catatan') }}
                        </p>
                    @endif
                </div>

            <div class="btn-group pull-right">
            <a href="{{URL('departements')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
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

