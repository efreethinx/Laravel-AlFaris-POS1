@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content-header')
      <h1>
        @lang('global.products.title')
        <small>List</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">@lang('global.products.title')</li>
      </ol>    
@stop

@section('content')   
<div class="row">
    <p>
        <div class="btn-group">
              <a id="link" class="btn btn-info">
              <i class="fa fa-plus fa-fw"></i> Tambah Satuan Produk</a>
              <a href="{{url('products')}}" class="btn btn-warning"><i class="fa fa-chevron-left fa-fw"></i> Kembali</a>
        </div>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">            
            @lang('global.app_list') Satuan Master Produk
        </div>

        <div class="panel-body table-responsive">
            <table id="list" class="table table-bordered table-striped dt-select">
                <thead>
                    <tr>
                        <!--
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        -->
                        <th width="30%">Nama Produk</th>
                        <th width="25%">Satuan</th>
                        <th width="15%" style="text-align: center;">Isi Packing</th>
                        <th width="15%">Satuan Kecil</th>
                        <th width="15%" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
    </div>
    @include('partials.footervar')
@stop


@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('products.mass_destroy') }}';
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
    
    
    <script src="{{asset('/js/uom.js')}}"></script>

    <!-- page script -->
    <script type="text/javascript">
    $(document).ready(function(){
        datatablesprodukuoms.init();
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