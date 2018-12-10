@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.akun.title')
        <small>Add</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('akun')}}"> @lang('global.akun.title')</a></li>
        <li class="active">@lang('global.app_create')</li>
      </ol>    
@stop

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['akun.store'],'class' => 'form-horizontal']) !!}

<div class="row">

<div class="col-xs-12">

    <div class="panel panel-default">
        
        <div class="panel-heading">
            @lang('global.app_create') Akun
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
                  <label for="subklasifikasi" class="col-sm-2 control-label">Subklasifikasi</label>
                  <div class="col-sm-3">
                    <div class="input-group">
                      {!! Form::select('subklasifikasi', $subklasifikasi, old('subklasifikasi'), ['class' => 'form-control', 'placeholder' => '-- Subklasifikasi --']) !!}
                      <span class="input-group-btn">
                        <!--
                        <button type="button" class="btn bg-success btn-flat" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-keyboard="false"> ... </button>
                        -->
                        <a href="{{route('subklasifikasi.create')}}" class="btn btn-primary"> ... </a>
                      </span>
                    </div>
                  </div>
                  <!--
                  <label for="nama" class="col-sm-1 control-label">Nama</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                    <input type="hidden" name="lbl_nama" id="lbl_nama">
                  </div>
                  -->
                </div>

                <!--
                <div class="form-group">
                    {!! Form::label('subklasifikasi', 'Subklasifikasi', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::select('subklasifikasi', $subklasifikasi, old('subklasifikasi'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    @if($errors->has('subklasifikasi'))
                     {{ $errors->first('subklasifikasi') }}
                    @endif
                </div>
                -->
                
                <div class="form-group">
                    {!! Form::label('kode_akun', 'Kode', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('kode_akun', old('kode_akun'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    @if($errors->has('kode_akun'))
                     {{ $errors->first('kode_akun') }}
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('nama_akun', 'Nama', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nama_akun', old('nama_akun'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_akun'))
                        <p class="help-block">
                            {{ $errors->first('nama_akun') }}
                        </p>
                    @endif
                </div>
                
                <div class="form-group">
                    {!! Form::label('nama_alias', 'Nama Alias ', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nama_alias', old('nama_alias'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}                    
                    </div>
                    <p class="help-block"></p>
                    @if($errors->has('nama_alias'))
                        <p class="help-block">
                            {{ $errors->first('nama_alias') }}
                        </p>
                    @endif
                </div>
                               
                <div class="form-group">                             

                    {!! Form::label('kas_bank', '.', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    <table class="table table-bordered table-conseded">
                        <tr>
                            <td style="width: 10px">
                            <!--
                                {!! Form::checkbox('kas_bank', old('kas_bank'),['class' => 'flat']) !!}
                                -->
                                {!! Form::checkbox('kas_bank', 'Y') !!}
                            </td>
                            <td>
                                {!! Form::label('kas_bank', 'Kas/Bank') !!}
                            </td>
                        </tr>
                    </table>
                    </div>

                    <div class="col-sm-4">
                    <table class="table table-bordered table-conseded">
                        <tr>
                            <td style="width: 10px">
                                <!--
                                {!! Form::checkbox('is_active', old('is_active'),['class' => 'flat']) !!}
                                
                                <input type="checkbox" name="is_active[]" class="flat">
                                -->
                                {!! Form::checkbox('is_active', 'Y') !!}
                            </td>
                            <td>
                                {!! Form::label('is_active', 'Tidak Aktif') !!}
                            </td>
                        </tr>
                    </table>
                </div>
                </div>
            
                <div class="form-group">

                    {!! Form::label('kurs', 'Kurs', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-2">
                    {!! Form::text('kurs', old('kurs'), ['class' => 'form-control', 'placeholder' => 'IDR']) !!}
                    </div>
                    
                    {!! Form::label('departement', 'Departement', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::select('departement', $departement, old('departement'), ['class' => 'form-control', 'placeholder' => '-- Departement --']) !!}
                    </div>
                    
                </div>     

        <div class="btn-group pull-right">
            <a href="{{URL('akun')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
            <button type="submit" class="btn btn-success" id="btnSubmit" style="margin-left: 5px;">
            <i class="fa fa-check fa-fw"></i> Save</button>
            </div>


        </div>

        

    </div>
    <div class="panel-footer">
            
        </div>

    </div>
</div>

    <!-- Modal form to add a post -->
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Data Klasifikasi Akun</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="title">Klasifikasi *</label>
                            <div class="col-sm-8">
                                <input name="title" type="text" class="form-control" id="title" autofocus>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="content">Sub Klasifikasi *</label>
                            <div class="col-sm-8">
                                <input type="text" name="content" class="form-control" id="content"> 
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success add" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-check'></span> Add
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


{!! Form::close() !!}

@stop


@section('javascript')
    <!-- Delay table load until everything else is loaded -->
    <script>
        $(window).load(function(){
            $('#postTable').removeAttr('style');
        })
    </script>

    <!-- AJAX CRUD operations -->
    <script type="text/javascript">
        // add a new post
        $(document).on('click', '.add-modal', function() {
            $('.modal-title').text('Add');
            $('#addModal').modal('show');
        });
        $('.modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'POST',
                url: 'posts',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'title': $('#title_add').val(),
                    'content': $('#content_add').val()
                },
                success: function(data) {
                    $('.errorTitle').addClass('hidden');
                    $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.title) {
                            $('.errorTitle').removeClass('hidden');
                            $('.errorTitle').text(data.errors.title);
                        }
                        if (data.errors.content) {
                            $('.errorContent').removeClass('hidden');
                            $('.errorContent').text(data.errors.content);
                        }
                    } else {
                        toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                        $('#postTable').prepend("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.title + "</td><td>" + data.content + "</td><td class='text-center'><input type='checkbox' class='new_published' data-id='" + data.id + " '></td><td>Just now!</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                        $('.new_published').iCheck({
                            checkboxClass: 'icheckbox_square-yellow',
                            radioClass: 'iradio_square-yellow',
                            increaseArea: '20%'
                        });

                    }
                },
            });
        });

        // Show a post
        $(document).on('click', '.show-modal', function() {
            $('.modal-title').text('Show');
            $('#id_show').val($(this).data('id'));
            $('#title_show').val($(this).data('title'));
            $('#content_show').val($(this).data('content'));
            $('#showModal').modal('show');
        });

    </script>


@endsection

