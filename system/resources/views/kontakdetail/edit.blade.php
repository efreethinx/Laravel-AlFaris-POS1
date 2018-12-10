@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.kontakdetail.title')
        <small>Update</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('kontak')}}"> @lang('global.kontakdetail.title')</a></li>
        <li class="active">@lang('global.app_update')</li>
      </ol>    
@stop

@section('content')
    
    {!! Form::model($kontakdetail, ['method' => 'PUT', 'route' => ['kontakdetail.update', $kontakdetail->id],'class' => 'form-horizontal']) !!}


<div class="row">

   <div class="col-xs-12">

   <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_create')
        </div>

        <div class="panel-body table-responsive">

                <div class="form-group">
                    {!! Form::label('kontak_id', 'Kontak ID', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kontak_id', old('kontak_id'), ['class' => 'form-control', 'readonly' => 'true', 'style'=>'background: #eee']) !!}
                    </div>
                </div>  

                <div class="form-group">
                    <?php
                        $kontak_name = App\Kontak::where('id',$kontak->kontak_id)->select('nama_kontak')->first();
                    ?>
                    {!! Form::label('kode_kontak', 'Kontak Nama', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kode_kontak', old('kode_kontak'), ['class' => 'form-control', 'readonly' => 'true', 'style'=>'background: #eee']) !!}
                    </div>                                       
                </div>  

                <div class="form-group">

                    {!! Form::label('alamat1', 'Alamat', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('alamat1', old('alamat1'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div>  

                <div class="form-group">

                    {!! Form::label('alamat2', 'Alamat 2', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('alamat2', old('alamat2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                </div>        
                
                <div class="form-group">

                    {!! Form::label('kota1', 'Kota', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    {!! Form::text('kota1', old('kota1'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    {!! Form::label('kode_pos1', 'Kode Pos', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    {!! Form::text('kode_pos1',  old('kode_pos1'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div> 


                <div class="form-group">

                    {!! Form::label('negara1', 'Negara', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('negara1', old('negara1'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                </div>     
                  
                
                <div class="form-group">

                    {!! Form::label('alamat_pengiriman', 'Alamat Pengiriman', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::select('alamat_pengiriman', $alamat, old('alamat_pengiriman'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    <!--
                    {!! Form::label('hari_diskon', 'Hari Discount', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('hari_diskon',  old('hari_diskon'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    -->
                    
                </div>     
                
                <div class="form-group">

                    {!! Form::label('alamat_pengiriman2', 'Alamat Pengiriman 2', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('alamat_pengiriman2', old('alamat_pengiriman2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    <!--
                    {!! Form::label('hari_jatuh_tempo', 'Hari Jatuh Tempo', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('hari_jatuh_tempo',  old('hari_jatuh_tempo'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    -->
                    
                </div> 

                <div class="form-group">

                    {!! Form::label('kota2', 'Kota', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    {!! Form::text('kota2', old('kota2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                    {!! Form::label('kode_pos2', 'Kode Pos', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    {!! Form::text('kode_pos2',  old('kode_pos2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    
                </div> 


                <div class="form-group">

                    {!! Form::label('negara2', 'Negara', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('negara2', old('negara2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                </div>     
                
                <div class="form-group">

                    {!! Form::label('kontak2', 'Kontak 2', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kontak2', old('kontak2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                </div>     
                
                <div class="form-group">

                    {!! Form::label('catatan', 'Catatan', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::textarea('catatan', old('catatan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>                    

                </div>  

                <div class="form-group">
                    <label for="input-file-max-fs" class="col-sm-2 control-label"></label>
                    <div class="col-sm-2">
                    <input type="file" 
                           name="photo" 
                           id="input-file-max-fs" 
                           class="dropify" 
                           data-max-file-size="2M"/>
                    </div>
                </div>   
                
                
          <div class="btn-group pull-right">
            <a href="{{URL('kontakdetail')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
            <button type="submit" class="btn btn-warning" id="btnSubmit" style="margin-left: 5px;">
            <i class="fa fa-check fa-refresh"></i> Update</button>
            </div>  
        </div>

        

    </div>
    <div class="panel-footer">
            <p>&nbsp;</p>
    </div>

    </div>
</div>

    {!! Form::close() !!}
@stop

@section('javascript')

    <script src="{{ asset('bower_components/dropify/dist/js/dropify.js') }}"></script>

        <script>
            $(document).ready(function(){
                // Basic
                $('.dropify').dropify();

                // Translated
                $('.dropify-fr').dropify({
                    messages: {
                        default: 'Glissez-déposez un fichier ici ou cliquez',
                        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                        remove:  'Supprimer',
                        error:   'Désolé, le fichier trop volumineux'
                    }
                });

                // Used events
                var drEvent = $('#input-file-events').dropify();

                drEvent.on('dropify.beforeClear', function(event, element){
                    return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                });

                drEvent.on('dropify.afterClear', function(event, element){
                    alert('File deleted');
                });

                drEvent.on('dropify.errors', function(event, element){
                    console.log('Has Errors');
                });

                var drDestroy = $('#input-file-to-destroy').dropify();
                drDestroy = drDestroy.data('dropify')
                $('#toggleDropify').on('click', function(e){
                    e.preventDefault();
                    if (drDestroy.isDropified()) {
                        drDestroy.destroy();
                    } else {
                        drDestroy.init();
                    }
                })
            });
        </script>
@endsection
