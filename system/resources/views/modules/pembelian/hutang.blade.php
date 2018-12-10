@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<div class="row">
        
    <div class="col-xs-12">
          
    <p>
        
              <a href="{{url('/')}}" class="btn btn-info">
              Tutup</a>
              {!! link_to_route('pembelian.hutang.excelHutang', 
              'Export to Excel', null, 
              ['class' => 'btn btn-success']) 
              !!}
        
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
                      <th class="text-left" width="20%">Pemasok</th>
                      <th class="text-center" width="20%">Mata Uang</th>
                      <th class="text-right" width="20%">Total Utang</th>
                      <th class="text-right" width="20%">Utang Terbayar</th>
                      <th class="text-right" width="20%">Saldo Utang</th>
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
        $(function(){
            /*-----------------------------------------------------------
             Delete Button clicked
             --------------------------------------------------------------*/
            $(document).on('click', '.btn-delete', function (e){e.preventDefault(); confirm_dialog($(this).parent('form')); });
            function confirm_dialog(form){
                BootstrapDialog.show({
                    title: 'Deleting a Record',
                    message: 'Are you sure you want to delete this record. This action cannot be undone.',
                    buttons: [ {
                        icon: 'fa fa-check',
                        label: 'Yes',
                        cssClass: 'btn-success btn-xs pull-left',
                        action: function(){
                            form.submit();
                        }
                    }, {
                        icon: 'fa fa-remove',
                        label: 'No',
                        cssClass: 'btn-danger btn-xs pull-right',
                        action: function(dialogItself){
                            dialogItself.close();
                        }
                    }]
                });
                return false;
            }
        });
    </script>

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
    
    
    <script src="{{asset('/js/pembelian.js')}}"></script>

    <!-- page script -->
    <script type="text/javascript">
    $(document).ready(function(){
        datatablesHutang.init();
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