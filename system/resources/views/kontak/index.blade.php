@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.kontak.title')
        <small>List</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">@lang('global.kontak.title')</li>
      </ol>    
@stop

@section('content')   
<div class="row">

    </br>
    </br>
    
    </br>
    
    <!-- search container -->
    <div class="panel panel-default">
         <!--
         <div class="panel-heading">            
            <h4 class="panel-title">Custom Filter [Case Sensitive]</h4>            
         </div> -->
         <div class="panel-body">
         <form method="POST" id="search-form" class="form-horizontal" action="{{ route('products.index') }}">

            <div class="form-group">
              <label for="nama_kontak" class="col-sm-2 control-label">Nama Kontak</label>
              <div class="col-sm-4">
              <input type="text" class="form-control" name="nama_kontak" id="nama_kontak" placeholder="nama kontak">
              </div>

              <!--
              <label for="kode_produk" class="col-sm-2 control-label">Kode Produk</label>
              <div class="col-sm-4">
              <input type="text" class="form-control" name="kode_produk" id="kode_produk" placeholder="kode produk">
              </div>
              -->
            </div>
            
            <div class="form-group">
              <label for="tipe" class="col-sm-2 control-label">Tipe Kontak</label>
              <div class="col-sm-4">
              <select type="text" class="form-control" name="tipe" id="tipe">
                <option value="" selected="true">Pilih Tipe Kontak</option>
                <option value="Pegawai">Pegawai</option>
                <option value="Supplier">Supplier</option>
                <option value="Customer">Customer</option>
                <option value="Reseller">Reseller</option>
              </select>
              </div>

              <!--
              <label for="tipe" class="col-sm-2 control-label">Tipe Kontak</label>
              <div class="col-sm-4">
              <input type="text" class="form-control" name="tipe" id="tipe" placeholder="Kategori">
            
              {{ Form::select('kategori_id', $kategori_list, old('kategori_id'), array('class'=>'form-control')) }}
             
              </div>
              
              <label for="is_active" class="col-sm-2 control-label">Aktif</label>
              <div class="col-sm-4">
              <select type="text" class="form-control" name="is_active" id="is_active">
                <option value="" selected="true" disabled="true">Pilih Status</option>
                <option value="0">Ya</option>
                <option value="1">Tidak</option>
              </select>
              </div>-->

            </div>

            <div class="form-group">
              <label for="kategori_id" class="col-sm-2 control-label">&nbsp;</label>
              <div class="col-sm-4">
              <button type="reset" onClick="window.location.reload()" name="btnReset" id="btnReset" class="btn btn-warning">Reset</button>
              <button type="submit" class="btn btn-primary" disabled="true">&nbsp;Tekan Tombol F5 (Refresh)&nbsp;</button>
              </div>
            </div>
            

          </form>
          </div>
    </div>
    <!-- /.panel -->

    <p>
        <a href="{{ route('kontak.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        {!! link_to_route('kontak.excel', 
            'Export to Excel', null, 
            ['class' => 'btn btn-success']) 
        !!}
        <!--
        <a href="{{ route('hargajuals.index') }}" class="btn btn-primary">Setup Harga Jual</a>
        -->
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list') Kontak
        </div>

        <div class="panel-body table-responsive">
            <table id="list" class="table table-bordered table-striped {{ count($kontak) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th width="10%">@lang('global.kontak.fields.kode_kontak')</th>
                        <th width="35%">@lang('global.kontak.fields.nama_kontak')</th>
                        <th width="10%">@lang('global.kontak.fields.kontak')</th>
                        <th width="10%">@lang('global.kontak.fields.kelompok')</th>
                        <th width="10%">@lang('global.kontak.fields.phone1')</th>
                        <th width="10%">@lang('global.kontak.fields.kurs')</th>
                        <th  width="30%">&nbsp;</th>
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
        window.route_mass_crud_entries_destroy = '{{ route('kontak.mass_destroy') }}';
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
    
    
    <script src="{{asset('/js/kontak.js')}}"></script>

    <!-- page script -->
    <script type="text/javascript">
    $(document).ready(function(){
       // datatablesKontak.init();
    });
    </script>

    <script type="text/javascript">
      var oTable = $('#list').DataTable({
        dom: "<'row'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>"+
             "<'row'<'col-xs-12't>>"+
             "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("kontak.list")  }}',
            "data": function (d) {
                    //d.id = $('#id').val();
                    //d.kode_kontak = $('#nama_kontak').val();
                    d.nama_kontak = $('#nama_kontak').val();                    
                    d.tipe = $('#tipe option:selected').val();
                    /*d.nama_program = $('#nama_program option:selected').val();
                    d.kode_biaya_syahriah = $('#kode_biaya_syahriah option:selected').val();
                    d.kode_biaya_infaq = $('#kode_biaya_infaq option:selected').val();
                    d.kode_biaya_kesekretariatan = $('#kode_biaya_kesekretariatan option:selected').val();
                    d.status_santri = $('#status_santri option:selected').val();
                    */
                }
                //"type": "POST"
            },
            'columns': [
                {data: 'kode_kontak', name: 'kode_kontak'},
                {data: 'nama_kontak', name: 'nama_kontak'},
                {data: 'kontak', name: 'kontak'},
                {data: 'tipe', name: 'tipe'},
                {data: 'phone1', name: 'phone1'},
                {data: 'kurs', name: 'kurs'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#search-form').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });

    $("#btnReset").on("click", function() {
        $("#search-form").trigger("reset");
        $(".selectpicker").selectpicker("val", "");
        oTable.draw();
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