@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@push('css')
	<style type="text/css">
		table
		{
		    counter-reset: rowNumber;
		}

		table tr > td:first-child
		{
		    counter-increment: rowNumber;
		}

		table tr td:first-child::before
		{
		    content: counter(rowNumber);
		    min-width: 1em;
		    margin-right: 0.5em;
		}
	</style>
@endpush

@section('content')
<div class="row">
        
    <div class="col-xs-12">
          
    <p>
        <div class="btn-group">
              <a href="{{route('kas.pengeluaran.create')}}" class="btn btn-info">
              <i class="fa fa-plus fa-fw"></i> Baru</a>
              </div>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list') Pengeluaran Kas
        </div>

        <div class="panel-body table-responsive">             
              
              <div class="table-responsive">                    
                <table id="list" class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th width="11%"># Tanggal</th>
                      <th width="15%">No. Referensi</th>
                      <th width="15%">Dibayar Kepada</th>
                      <th width="20%">Keterangan</th>
                      <th  width="15%">Proyek</th>
                      <th  width="12%" class="text-right">Nilai</th>
                      <th class="text-center" width="12%">Action</th>
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
    
    
    <script src="{{asset('/js/keuangan.js')}}"></script>

    <!-- page script -->
    <script type="text/javascript">
    $(document).ready(function(){
        datatablesPengeluaran.init();
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