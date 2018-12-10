@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.subklasifikasi.title')
        <small>Add</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('subklasifikasi')}}"> @lang('global.subklasifikasi.title')</a></li>
        <li class="active">@lang('global.app_create')</li>
      </ol>    
@stop

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['subklasifikasi.store'],'class' => 'form-horizontal']) !!}

<div class="row">

<div class="col-xs-12">

       <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body table-responsive">

                <div class="form-group">
                    {!! Form::label('klasifikasi', 'Klasifikasi *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('klasifikasi', old('klasifikasi'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('klasifikasi'))
                        <p class="help-block">
                            {{ $errors->first('klasifikasi') }}
                        </p>
                    @endif
                </div>                             
                  
                <div class="form-group">
                    {!! Form::label('subklasifikasi', 'Sub Klasifikasi *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('subklasifikasi', old('subklasifikasi'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('subklasifikasi'))
                        <p class="help-block">
                            {{ $errors->first('subklasifikasi') }}
                        </p>
                    @endif
                </div>                             
               

               <div class="btn-group pull-right">
            <a href="{{URL('akun/create')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
            <button type="submit" class="btn btn-success" id="btnSubmit" style="margin-left: 5px;">
            <i class="fa fa-check fa-fw"></i> Save</button>
            </div>   
                                          

        </div>

        

    </div>

    <div class="panel-footer">
            
        </div>

    </div>
</div>

    {!! Form::close() !!}

@stop

