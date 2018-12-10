@extends('layouts.app')

@push('css')
    <!-- DataTables 
    <link rel="stylesheet" href="{{asset('/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('/bower_components/sweetalert/dist/sweetalert.css')}}">
    -->
@endpush

@section('content-header')
      <h1>
        Pendidikan
        <small>List</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pendidikan</li>
      </ol>    
@stop

@section('content')

<div class="row">
        
        <div class="col-xs-12">
          
          <div class="box box-info">
            
            <div class="box-body">
              
              <div class="btn-group">
                <a href="{{url('pendidikan/add')}}" class="btn btn-info"><i class="fa fa-plus fa-fw"></i> Add</a>
                <a href="{{url('pendidikan/report')}}" class="btn btn-default"><i class="fa fa-print fa-fw"></i> Priview</a>
                <!--
                <a href="{{url('warna/detail')}}" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Detail</a>
                -->
              </div>
              <br><br>
              
              <div class="table-responsive">                    
                <table id="list" class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th class="text-center" width="10%">Kode</th>
                      <th class="text-center" width="35%">Nama</th>
                      <th class="text-center" width="10%">Kontak</th>
                      <th class="text-center" width="10%">Kelompok</th>
                      <th class="text-center" width="10%">Telepon</th>
                      <th class="text-center" width="10%">Kurs</th>
                      <th class="text-center" width="15%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>              
              </div>
              <!-- end table-responsive -->
            
            </div>
            <!-- /.box-body -->
          
          </div>
          <!-- /.box -->
        
        </div>
        <!-- /.col -->
      
</div>

@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('kontak.mass_destroy') }}';
    </script>
@endsection

@push('javascripts')

    <!-- DataTables -->
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>    
    <script src="{{asset('/bower_components/sweetalert/dist/sweetalert.min.js')}}"></script>
    
    <script src="{{asset('/js/kontak.js')}}"></script>

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
