@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row">
        
    <div class="col-xs-12">
          
    <p>
        <div class="btn-group">
              <a href="{{route('piutang.create')}}" class="btn btn-info">
              <i class="fa fa-plus fa-fw"></i> Baru</a>
              </div>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">             
              
              <div class="table-responsive">                    
                <table id="list" class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th class="text-center" width="10%">Tanggal</th>
                      <th class="text-center" width="12%">No. Reff</th>
                      <th class="text-center" width="30%">Nama Pemasok</th>
                      <th class="text-center" width="13%">Nilai</th>
                      <th class="text-center" width="13%">Action</th>
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

@include('partials.footervar')

@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('hargajual.mass_destroy') }}';
    </script>
@endsection

@push('javascripts')

    <script type="text/javascript">
      function formatDate (input) {
      var datePart = input.match(/\d+/g),
      year = datePart[0].substring(2), // get only two digits
      month = datePart[1], day = datePart[2];

      return day+'/'+month+'/'+year;
      }
      //formatDate ('2010/01/18'); // "18/01/10"
    </script>

    <script type="text/javascript">
        var id = winvar.id;
        var scrt_var = 'add/' + id;
        document.getElementById("link").setAttribute("href",scrt_var);
    </script>

    <!-- DataTables -->
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>    
    <script src="{{asset('/bower_components/sweetalert/docs/assets/sweetalert/sweetalert.min.js')}}"></script>
    
    
    <script src="{{asset('/js/penjualan.js')}}"></script>

    <!-- page script -->
    <script type="text/javascript">
    $(document).ready(function(){
        datatablesPiutang.init();
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