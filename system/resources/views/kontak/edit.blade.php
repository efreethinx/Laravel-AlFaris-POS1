@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.kontak.title')
        <small>Update</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('kontak')}}"> @lang('global.kontak.title')</a></li>
        <li class="active">@lang('global.app_update')</li>
      </ol>    
@stop

@section('content')
    
    {!! Form::model($kontak, ['method' => 'PUT', 'route' => ['kontak.update', $kontak->id],'class' => 'form-horizontal']) !!}


<div class="row">

<div class="col-xs-12">

   <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body table-responsive">

                <div class="form-group">

                    {!! Form::label('kode_kontak', 'Kode', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kode_kontak', old('kode_kontak'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    {!! Form::label('kurs', 'Mata Uang', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    {!! Form::text('kurs',  old('kurs'), ['class' => 'form-control', 'placeholder' => 'IDR']) !!}
                    </div>
                    
                </div>  

                <div class="form-group">

                    {!! Form::label('nama_kontak', 'Nama', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-8">
                    {!! Form::text('nama_kontak', old('nama_kontak'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                </div>       

                <div class="form-group">

                    
                    {!! Form::label('tipe', 'Tipe', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {{ Form::select('tipe', [
                       'Pegawai' => 'Pegawai',
                       'Supplier' => 'Supplier',
                       'Customer' => 'Customer'], old('tipe'), ['class' => 'form-control', 'placeholder' => '']) }}
                    </div>

                                       
                    {!! Form::label('jenis', 'Wilayah', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::select('jenis',  [
                       'Cikampek' => 'Cikampek',
                       'Cirebon' => 'Cirebon',
                       'Garut' => 'Garut',
                       'Indramayu' => 'Indramayu',
                       'Kuningan' => 'Kuningan',
                       'Majalengka' => 'Majalengka',
                       'Tasik' => 'Tasik'
                       ], old('jenis'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div> 

                <div class="form-group">

                    {!! Form::label('klasifikasi', 'Alamat ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('klasifikasi', old('klasifikasi'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                </div>     
                
                <div class="form-group">

                    {!! Form::label('kontak', 'Kontak', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kontak', old('kontak'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    {!! Form::label('npwp', 'NPWP', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('npwp',  old('npwp'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div>     
                
                <div class="form-group">

                    {!! Form::label('jabatan', 'Jabatan', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('jabatan', old('jabatan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    {!! Form::label('batas_kredit', 'Batas Kredit', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('batas_kredit',  old('batas_kredit'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div>     
                
                <div class="form-group">

                    {!! Form::label('phone1', 'Telepon 1', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('phone1', old('phone1'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    {!! Form::label('hari_diskon', 'Hari Discount', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('hari_diskon',  old('hari_diskon'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div>     
                
                <div class="form-group">

                    {!! Form::label('phone2', 'Telepon 2', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('phone2', old('phone2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    {!! Form::label('hari_jatuh_tempo', 'Hari Jatuh Tempo', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('hari_jatuh_tempo',  old('hari_jatuh_tempo'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div>     
                
                <div class="form-group">

                    {!! Form::label('fax', 'Fax', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('fax', old('fax'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    {!! Form::label('diskon_awal', 'Diskon Awal %', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('diskon_awal',  old('diskon_awal'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div>     
                
                <div class="form-group">

                    {!! Form::label('handphone', 'Handphone', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('handphone', old('handphone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    {!! Form::label('denda_telat', 'Denda Keterlambatan %', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('denda_telat',  old('denda_terlamtbat'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div>  

                <div class="form-group">

                    {!! Form::label('email', 'E-mail', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                </div> 

                <div class="form-group">

                    {!! Form::label('situs', 'Situs Website', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('situs', old('situs'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                </div> 

                    <div class="btn-group pull-right">
            <a href="{{URL('kontak')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
            <button type="submit" class="btn btn-warning" id="btnSubmit" style="margin-left: 5px;">
            <i class="fa fa-check fa-refresh"></i> Update</button>
            </div>

                   
            
        </div>

        

    </div>

    <div class="panel-footer">
            
        </div>

    </div>
</div>

    {!! Form::close() !!}
@stop

