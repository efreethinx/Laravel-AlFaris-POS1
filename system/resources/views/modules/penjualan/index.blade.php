@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-xs-12">

    <p>

              <a href="{{route('penjualan.create')}}" class="btn btn-info">
              <i class="fa fa-plus fa-fw"></i> Baru</a>
              {!! link_to_route('penjualan.excel',
              'Export to Excel', null,
              ['class' => 'btn btn-success']) !!}
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
                      <th class="text-center" width="11%">Tanggal</th>
                      <th class="text-center" width="12%">No. Faktur</th>
                      <th class="text-center" width="12%">No. Pesanan</th>
                      <th class="text-center" width="35%">Nama Pelanggan</th>
                      <!--
                      <th class="text-center" width="10%">Proyek</th>
                      -->
                      <th class="text-center" width="15%">Nilai</th>
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

@include('partials.footervar')

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
<!-- End Modal -->

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
