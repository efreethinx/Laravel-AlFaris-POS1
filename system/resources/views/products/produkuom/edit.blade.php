@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.produkuoms.title')
        <small>Add</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('produkuoms')}}"><i class="fa fa-dashboard"></i> @lang('global.produkuoms.title')</a></li>
        <li class="active">@lang('global.app_create')</li>
      </ol>    
@stop

@section('content')
    
 {!! Form::model($hargajual, ['method' => 'POST', 'route' => ['products.produkuoms.update', $hargajual->id],'class' => 'form-horizontal']) !!}

<div class="row">

<div class="col-xs-12">

    <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body table-responsive">

                <div class="form-group">
                    {!! Form::label('produk_id', 'Produk ID *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('produk_id', old('produk_id'), ['class' => 'form-control', 'readonly' => 'true', 'style'=>'background: #eee']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('produk_id'))
                        <p class="help-block">
                            {{ $errors->first('produk_id') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('nama_produk', 'Nama Produk', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('nama_produk', $produks->nama_produk, ['class' => 'form-control', 'readonly' => 'true', 'style'=>'background: #eee']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_produk'))
                        <p class="help-block">
                            {{ $errors->first('nama_produk') }}
                        </p>
                    @endif
                </div>
                 
                <div class="form-group">
                    {!! Form::label('uom_id', 'Satuan', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    <select class="form-control" name="uom_id" id="uom_id">
                    @foreach(explode(',', $produk->uom_id) as $info)                        
                        <option value="{{ $info }}">{{ $info }}</option>                        
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
                    {!! Form::label('isi_pcs', 'Isi Satuan Kecil (pcs)', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('isi_pcs', old('isi_pcs'), ['class' => 'form-control', 'placeholder' => '', 'style' => 'text-right']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('isi_pcs'))
                        <p class="help-block">
                            {{ $errors->first('isi_pcs') }}
                        </p>
                    @endif
                </div>

         <div class="btn-group pull-right">
            <a href="{{url('products')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
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

