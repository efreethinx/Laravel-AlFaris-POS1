@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.uoms.title')
        <small>Update</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('uoms')}}"><i class="fa fa-dashboard"></i> @lang('global.uoms.title')</a></li>
        <li class="active">@lang('global.app_update')</li>
      </ol>    
@stop

@section('content')
    
    {!! Form::model($uoms, ['method' => 'PUT', 'route' => ['uoms.update', $uoms->id],'class' => 'form-horizontal']) !!}


<div class="row">

<div class="col-xs-12">

        <!-- <div class="box box-success">
        <div class="box-header with-border">
            @lang('global.app_create')
        </div>
        
        <div class="box-body">
        -->

    <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body table-responsive"> 

                <div class="form-group">
                    {!! Form::label('kode_uom', 'Kode Satuan *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('kode_uom', old('kode_uom'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('kode_uom'))
                        <p class="help-block">
                            {{ $errors->first('kode_uom') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('nama_uom', 'Nama Satuan *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nama_uom', old('nama_uom'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_uom'))
                        <p class="help-block">
                            {{ $errors->first('nama_uom') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('deskripsi', 'Deskripsi', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::textarea('deskripsi', old('deskripsi'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('deskripsi'))
                        <p class="help-block">
                            {{ $errors->first('deskripsi') }}
                        </p>
                    @endif
                </div>
            
        <div class="btn-group pull-right">
            <a href="{{URL('uoms')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
            <button type="submit" class="btn btn-warning" id="btnSubmit" style="margin-left: 5px;">
            <i class="fa fa-refresh fa-fw"></i> Update</button>
        </div>
            
            
        </div>

        <div class="panel-footer full-right">
            <p>&nbsp</p>
        </div>

    </div>

    </div>
</div>

    {!! Form::close() !!}
@stop

