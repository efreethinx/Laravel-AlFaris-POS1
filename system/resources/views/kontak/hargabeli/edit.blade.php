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
    
    {!! Form::model($hargabeli, ['method' => 'PUT', 'route' => ['hargabeli.update', $hargabeli->id],'class' => 'form-horizontal']) !!}


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
                    {!! Form::label('kontak_id', 'Nama Pemasok', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    <?php 
                      $kontak = DB::table('kontaks')->where('id','=',$hargabeli->kontak_id)->first();
                    ?>
                    {!! Form::hidden('kontak_id', old('kontak_id'), ['class' => 'form-control', 'placeholder' => '', 'readonly'=>'true']) !!}
                    <input type="text" name="nama_kontak" class="form-control" value="{{ $kontak->nama_kontak }}" readonly="true">
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('kontak_id'))
                        <p class="help-block">
                            {{ $errors->first('kontak_id') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('produk_id', 'Produk', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    <?php 
                      $produk = DB::table('products')->where('id','=',$hargabeli->produk_id)->first();
                    ?>
                    <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" readonly="true">
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('produk_id'))
                        <p class="help-block">
                            {{ $errors->first('produk_id') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('uom_id', 'Satuan', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    <?php
                      $uoms = DB::table('uoms')->pluck('kode_uom','kode_uom');
                    ?>
                      <select class="form-control" name="uom_id" id="uom_id">
                          @foreach($uoms as $val)                         
<option value="{{ $val }}" {{ Input::old('uom_id') == $uoms ? 'selected="selected"' : '' }}>{{ $val }}</option>
                          @endforeach
                      </select>
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('uom_id'))
                        <p class="help-block">
                            {{ $errors->first('uom_id') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('harga_beli_khusus', 'Harga Beli', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('harga_beli_khusus', old('harga_beli_khusus'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('harga_beli_khusus'))
                        <p class="help-block">
                            {{ $errors->first('harga_beli_khusus') }}
                        </p>
                    @endif
                </div>
            
        <div class="btn-group pull-right">
            <a href="{{URL('hargabeli')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
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

