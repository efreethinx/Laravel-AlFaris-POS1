@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.departements.title')
        <small>List</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">@lang('global.departements.title')</li>
      </ol>    
@stop

@section('content') 
<div class="row">  
    <p>
        <a href="{{ route('departements.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        {!! link_to_route('departements.excel', 
            'Export to Excel', null, 
            ['class' => 'btn btn-success']) 
        !!}
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list') Departement
        </div>

        <div class="panel-body table-responsive">
            <table id="list" class="table table-bordered table-striped {{ count($departements) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th width="10%">@lang('global.departements.fields.kode_departements')</th>
                        <th width="50%">@lang('global.departements.fields.nama_departements')</th>
                        <th width="30%">@lang('global.departements.fields.manager')</th>
                        <th width="10%">Aksi</th>

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
        window.route_mass_crud_entries_destroy = '{{ route('departements.mass_destroy') }}';
    </script>
@endsection

@push('javascripts')

    <!--
    <script type="text/javascript">
        var id = winvar.id;
        var scrt_var = 'create/' + id;
        document.getElementById("link").setAttribute("href",scrt_var);
    </script>
    -->

    <!-- DataTables -->
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>    
    <script src="{{asset('/bower_components/sweetalert/docs/assets/sweetalert/sweetalert.min.js')}}"></script>
    
    
    <script src="{{asset('/js/departement.js')}}"></script>

    <!-- page script -->
    <script type="text/javascript">
    $(document).ready(function(){
        datatables.init();
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