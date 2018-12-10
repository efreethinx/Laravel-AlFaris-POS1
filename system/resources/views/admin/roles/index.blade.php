@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row">
    <h3 class="page-title">@lang('global.roles.title')</h3>
    <p>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table id="list" class="table table-bordered table-striped {{ count($roles) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th>@lang('global.roles.fields.name')</th>
                        <!--
                        <th>@lang('global.roles.fields.permission')</th>
                        -->
                        <th width="20%">&nbsp;</th>
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.roles.mass_destroy') }}';
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
    
    
    <script src="{{asset('/js/admin.js')}}"></script>

    <!-- page script -->
    <script type="text/javascript">
    $(document).ready(function(){
        datatablesRoles.init();
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