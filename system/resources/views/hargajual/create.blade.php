@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.hargajual.title')
        <small>Add</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('hargajual')}}"><i class="fa fa-dashboard"></i> @lang('global.hargajual.title')</a></li>
        <li class="active">@lang('global.app_create')</li>
      </ol>    
@stop

@section('content')
    
{{ Form::open(array('class' => 'form-horizontal', 'id' => 'frmData')) }}

<div class="row">

<div class="col-xs-12">

    <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body table-responsive">

                <div class="form-group">
                    {!! Form::label('kontak_id', 'Kontak ID *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kontak_id', old('kontak_id'), ['class' => 'form-control', 'readonly' => 'true', 'style'=>'background: #eee']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('kontak_id'))
                        <p class="help-block">
                            {{ $errors->first('kontak_id') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('kode_kontak', 'Kode Kontak *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kode_kontak', $kontak->kode_kontak, ['class' => 'form-control', 'readonly' => 'true', 'style'=>'background: #eee']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('kode_kontak'))
                        <p class="help-block">
                            {{ $errors->first('kode_kontak') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('date_add', 'Tanggal', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::date('date_add', old('date_add'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('date_add'))
                        <p class="help-block">
                            {{ $errors->first('date_add') }}
                        </p>
                    @endif
                </div>
                 
                <div class="form-group">
                    {!! Form::label('produk', 'Produk', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::select('produk', $produk, old('produk'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('produk'))
                        <p class="help-block">
                            {{ $errors->first('produk') }}
                        </p>
                    @endif
                </div>
                 
                <div class="form-group">
                    {!! Form::label('harga_jual', 'Harga Jual', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('harga_jual', old('harga_jual'), ['class' => 'form-control', 'placeholder' => '', 'style' => 'text-right']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('harga_jual'))
                        <p class="help-block">
                            {{ $errors->first('harga_jual') }}
                        </p>
                    @endif
                </div>

         <div class="btn-group pull-right">
            <a href="{{url('kontak')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
            <button type="submit" class="btn btn-success" id="btnSubmit" style="margin-left: 5px;">
            <i class="fa fa-check fa-fw"></i> Save</button>
            </div>
                            
        </div>

        

    </div>

    <div class="box-footer">
            
        </div>

    </div>
</div>
@include('partials.footervar')

{!! Form::close() !!}

@stop

@push('javascripts')
    <script type="text/javascript">
      var id = winvar.id;
      $('#kontak_id').val(id);

      var url = 'kontak/hargajual/create/'+id;
      //var url2 = id;
      document.getElementById("frmData").setAttribute("href",url);
      //document.getElementById("tabDet").setAttribute("href",id);
      //alert(url);    

      getSelectedRow = function(id){
      var id = winvar.id;
      db.transaction(function(transaction) {
            transaction.executeSql('select kode_kontak from kontaks where id ='+id);
      });
      };

      selectedRowValues = function(transaction,result)
      {
        for(var i = 0; i < result.rows.length; i++)
        {
            var row = result.rows.item(i);
                $('#kode_kontak').val(row['kode_kontak']);
                alert(row['kode_kontak']);
        }
      };

    </script>

    <script type="text/javascript">
        var id = winvar.id;
        var scrt_var = 'hargajual/' + id;
        document.getElementById("linkback").setAttribute("href",scrt_var);
    </script>
@endpush    

