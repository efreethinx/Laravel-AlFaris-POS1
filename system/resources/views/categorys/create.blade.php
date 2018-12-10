@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.categorys.title')
        <small>Add</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('categorys')}}"> @lang('global.categorys.title')</a></li>
        <li class="active">@lang('global.app_create')</li>
      </ol>    
@stop

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['categorys.store'],'class' => 'form-horizontal']) !!}

<div class="row">

<div class="col-xs-12">

    <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_create') Kategori
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
                    {!! Form::label('kode_kategori', 'Kode Kategori *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('kode_kategori', old('kode_kategori'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('kode_kategori'))
                        <p class="help-block">
                            {{ $errors->first('kode_kategori') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('nama_kategori', 'Nama Kategori *', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nama_kategori', old('nama_kategori'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_kategori'))
                        <p class="help-block">
                            {{ $errors->first('nama_kategori') }}
                        </p>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('departement_id', 'Departement', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::select('departement_id', $departement, old('departement_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('departement_id'))
                        <p class="help-block">
                            {{ $errors->first('departement_id') }}
                        </p>
                    @endif
                </div>

                
                <div class="form-group">
                <label class="col-sm-2 control-label lbl-menu">&nbsp; </label>
                 <!-- first block -->
                <div class="col-sm-5">
                        <table class="table table-bordered table-condensed">                             
                        <tr>
                          <td style="width: 10px">
                              <label>
                                {!! Form::checkbox('sifat_persediaan_disimpan', 'Y') !!}
                              </label>                            
                          </td>
                          <td>Disimpan</td>
                        </tr>                          
                                              
                        <tr>
                          <td style="width: 10px">
                              <label>
                                {!! Form::checkbox('sifat_persediaan_dibeli', 'Y') !!}
                              </label>                            
                          </td>
                          <td>Dibeli</td>
                        </tr>                          
                                              
                        <tr>
                          <td style="width: 10px">
                              <label>
                                {!! Form::checkbox('sifat_persediaan_dijual', 'Y') !!}
                              </label>                            
                          </td>
                          <td>Dijual</td>
                        </tr>
                        </table>
                </div>                   

                <!-- Second block -->
                <div class="col-sm-5">
                        <table class="table table-bordered table-condensed">                             
                        <tr>
                          <td style="width: 10px">
                              <label>
                                {!! Form::checkbox('sistem_persediaan_average_costing', 'Y') !!}
                              </label>                            
                          </td>
                          <td>Average Costing</td>
                        </tr>                          
                        </table>
                </div> 
                </div>                  
                              
                <div class="form-group">
                    
                    {!! Form::label('akun_harga_pokok', 'Akun Harga Pokok', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::select('akun_harga_pokok', $akun_list, old('akun_harga_pokok'), ['id'=>'mySelect','class' => 'form-control', 'placeholder' => '-- Pilih Akun Kas --', 'onchange' => 'myFunction()' ]) !!}
                    </div>
                    <b><label id="demo" class="control-label"></label></b>
                    <p class="help-block"></p>
                    @if($errors->has('akun_harga_pokok'))
                        <p class="help-block">
                            {{ $errors->first('akun_harga_pokok') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('akun_penjualan', ' Akun Penjualan', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::select('akun_penjualan', $akun_list, old('akun_penjualan'), ['id'=>'mySelectAkunPenjualan','class' => 'form-control', 'placeholder' => '', 'onchange' => 'myFunctionAkunPenjualan()']) !!}
                    </div>
                    <b><label id="akun_penjualan_nama_akun" class="control-label"></label></b>
                    <p class="help-block"></p>
                    @if($errors->has('akun_penjualan'))
                        <p class="help-block">
                            {{ $errors->first('akun_penjualan') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('akun_persediaan', 'Akun Persediaan', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::select('akun_persediaan', $akun_list, old('akun_persediaan'), ['id'=>'mySelectAkunPersediaan', 'class' => 'form-control', 'placeholder' => '', 'onchange' => 'myFunctionAkunPersediaan()']) !!}
                    </div>
                    <b><label id="akun_persediaan_nama_akun" class="control-label"></label></b>
                    <p class="help-block"></p>
                    @if($errors->has('akun_persediaan'))
                        <p class="help-block">
                            {{ $errors->first('akun_persediaan') }}
                        </p>
                    @endif
                </div>
                

                <div class="btn-group pull-right">
                    <a href="{{URL('categorys')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
                    <button type="submit" class="btn btn-success" id="btnSubmit" style="margin-left: 5px;">
                    <i class="fa fa-check fa-fw"></i> Save</button>
                </div>       
            

        

            </div>
    

    <div class="panel-footer">
        <p>&nbsp</p>
    </div>



</div>

    {!! Form::close() !!}

@stop

@push('javascripts')
    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("mySelect").value;
            var id = x;
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('kas.transfer.findNamaAkun')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    document.getElementById("demo").innerHTML = data.nama_akun;
                }
            });
            
        };  

        function myFunctionAkunPenjualan() {
            var x = document.getElementById("mySelectAkunPenjualan").value;
            var id = x;
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('kas.transfer.findNamaAkun')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    document.getElementById("akun_penjualan_nama_akun").innerHTML = data.nama_akun;
                }
            });
            
        };     

        function myFunctionAkunPersediaan() {
            var x = document.getElementById("mySelectAkunPersediaan").value;
            var id = x;
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('kas.transfer.findNamaAkun')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    document.getElementById("akun_persediaan_nama_akun").innerHTML = data.nama_akun;
                }
            });
            
        };  

    </script>
@endpush

