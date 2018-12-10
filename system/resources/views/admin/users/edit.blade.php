@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.5/css/select.dataTables.min.css">
<style type="text/css">
    .warna-text {
       color: #FFFFFF;
    }
    .warna-dasar {

    }
</style>
@stop

@section('content-header')
      <h1>
        @lang('global.users.title')
        <small>Add</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('admin/users')}}"> @lang('global.users.title')</a></li>
        <li class="active">@lang('global.app_update')</li>
      </ol>
@stop
@section('content')

    {!! Form::model($user, ['method' => 'PUT', 'route' => ['admin.users.update', $user->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit') User / Pengguna
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('username', 'Username *', ['class' => 'col-xs-2 control-label']) !!}
                    <div class="col-xs-10">
                    {!! Form::text('username', old('username'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly' => 'true']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('username'))
                        <p class="help-block">
                            {{ $errors->first('username') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Name*', ['class' => 'col-xs-2 control-label']) !!}
                    <div class="col-xs-10">
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>

                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', 'Email*', ['class' => 'col-xs-2 control-label']) !!}
                    <div class="col-xs-10">
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>

                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>

            <!--
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('password', 'Password*', ['class' => 'col-xs-2 control-label']) !!}
                    <div class="col-xs-10">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>

                    <p class="help-block"></p>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>
            -->

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('roles', 'Roles*', ['class' => 'col-xs-2 control-label']) !!}
                    <div class="col-xs-10">
                    {!! Form::select('roles[]', $roles, old('roles'), ['class' => 'form-control', 'required' => '']) !!}
                    </div>

                    <p class="help-block"></p>
                    @if($errors->has('roles'))
                        <p class="help-block">
                            {{ $errors->first('roles') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
              <?php
               $gudang = App\Gudang::where('id',$user->gudang_id)->first();
               $departement = App\Departement::where('id',$user->departement_id)->first();
              ?>
                <div class="col-xs-12 form-group">
                    {!! Form::label('gudang_id', 'Akses Gudang', ['class' => 'col-xs-2 control-label']) !!}
                    <div class="col-xs-10">
                    <div class="input-group">
                    {!! Form::hidden('gudang_id', $user->gudang_id, old('gudang_id'), ['class' => 'form-control']) !!}
                    <input type="text" name="nama_gudang" id="nama_gudang" readonly="true" value="{{ $gudang->nama_gudang }}" class="form-control">
                    <span class="input-group-btn">
                <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModalGudang" data-backdrop="static" data-keyboard="false">Cari</button>
                </span>
                    </div>
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('gudang_id'))
                        <p class="help-block">
                            {{ $errors->first('gudang_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">

                    {!! Form::label('departement_id', 'Departement', ['class' => 'col-xs-2 control-label']) !!}
                    <div class="col-xs-10">
                    <div class="input-group">
                    {!! Form::hidden('departement_id', $user->departement_id, old('departement_id'), ['class' => 'form-control']) !!}
                    <input type="text" name="nama_departement" readonly="true" id="nama_departement" value="{{ $departement->nama_departement }}" class="form-control">
                    <span class="input-group-btn">
                <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModalDepartement" data-backdrop="static" data-keyboard="false">Cari</button>
                </span>
                    </div>
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('departement_id'))
                        <p class="help-block">
                            {{ $errors->first('departement_id') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <a href="{{ url('/admin/users') }}" class="btn btn-warning">Batal</a>
    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-success']) !!}


    {!! Form::close() !!}
    @include('gudang.modalgudang')
    @include('departements.modaldepartement')
</div>
@stop

@push('javascripts')
<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#tabel_gudang').DataTable({
        select: 'single'
    });

    document.getElementById('btn_kontakx').onclick = function()
    {
      let rows   = table.rows( { selected: true } );
      var result = table.cells( rows.nodes(), 0 ).data();
      //console.log(result);
      //alert(result[0]);
      var id = result[0];
      var dataId={'id':id};

      $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('admin.users.findGudang')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    //alert(data.nama_gudang);
                    $('#nama_gudang').val(data.nama_gudang);
                    $('#gudang_id').val(data.id);
                    $('#myModalGudang').modal('hide');
                }
          });

    };
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#tabel_departement').DataTable({
        select: 'single'
    });

    document.getElementById('btn_dep').onclick = function()
    {
      let rows   = table.rows( { selected: true } );
      var result = table.cells( rows.nodes(), 0 ).data();
      //console.log(result);
      //alert(result[0]);
      var id = result[0];
      var dataId={'id':id};

      $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('admin.users.findDep')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    //alert(data.nama_departement);
                    $('#nama_departement').val(data.nama_departement);
                    $('#departement_id').val(data.id);
                    $('#myModalDepartement').modal('hide');
                }
          });

    };
    });
</script>
@endpush
