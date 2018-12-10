@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.akun.title')
        <small>List</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">@lang('global.akun.title')</li>
      </ol>    
@stop

@section('content')   
<div class="row">
    <p>
        <a href="{{ route('akun.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        {!! link_to_route('akun.excel', 
            'Export to Excel', null, 
            ['class' => 'btn btn-success']) 
        !!}
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list') Akun
        </div>

        <div class="panel-body table-responsive">
            <table id="list" class="table table-bordered table-striped {{ count($akun) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th width="20%">@lang('global.akun.fields.kode_akun')</th>
                        <th width="40%">@lang('global.akun.fields.nama_akun')</th>
                        <th width="10%">@lang('global.akun.fields.subklasifikasi')</th>
                        <th width="10%">@lang('global.akun.fields.klasifikasi')</th>
                        <th width="10%">@lang('global.akun.fields.kas_bank')</th>
                        <th width="20%" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    </div>
@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('akun.mass_destroy') }}';
    </script>
@endsection


@push('javascripts')

    <script type="text/javascript">
        var id = winvar.id;
        var scrt_var = 'create/' + id;
        document.getElementById("link").setAttribute("href",scrt_var);
    </script>

    <!-- DataTables -->
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>    
    <script src="{{asset('/bower_components/sweetalert/docs/assets/sweetalert/sweetalert.min.js')}}"></script>
    
    
    <script src="{{asset('/js/akun.js')}}"></script>

    <!-- page script -->
    <script type="text/javascript">
    $(document).ready(function(){
        datatablesAkun.init();
    });
    </script>

        <script>
        function ConfirmDelete()
        {
          var x = confirm("Anda yakin akan menghapus data ini ?");
          if (x)
              return true;
          else
              return false;
          };

        function ConfirmEdit()
        {
          var x = confirm("Anda yakin akan merubah data ini ?");
          if (x)
              return true;
          else
              return false;
          }; 
    </script>    

@endpush