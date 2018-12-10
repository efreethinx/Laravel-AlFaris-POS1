@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@push('css')
   <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/css/dataTables.checkboxes.css" rel="stylesheet" />
@endpush

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
<h3><a href="https://www.gyrocode.com/projects/jquery-datatables-checkboxes/">jQuery DataTables Checkboxes</a></h3>
<a href="https://www.gyrocode.com/projects/jquery-datatables-checkboxes/">See full article on Gyrocode.com</a>
<hr><br>  
<form id="frm-example" method="POST">
<table id="example" class="display table-bordered table-striped" cellspacing="0" width="100%">
   <thead>
      <tr>
         <th></th>
         <th>Name</th>
         <th>Position</th>
         <th>Office</th>
         <th>Extn</th>
         <th>Start date</th>
         <th>Salary</th>
      </tr>
   </thead>
   <tfoot>
      <tr>
         <th></th>
         <th>Name</th>
         <th>Position</th>
         <th>Office</th>
         <th>Age</th>
         <th>Start date</th>
         <th>Salary</th>
      </tr>
   </tfoot>
</table>
<hr>
<p>Press <b>Submit</b> and check console for URL-encoded form data that would be submitted.</p>
<p><button>Submit</button></p>
<p><b>Selected rows data:</b></p>
<pre id="example-console-rows"></pre>
<p><b>Form data as submitted to the server:</b></p>
<pre id="example-console-form"></pre>
</form>

</div>
@stop

@push('javascripts')
  
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/js/dataTables.checkboxes.min.js"></script>

   <script type="text/javascript">

      $(document).ready(function() {
      var table = $('#example').DataTable({
         'ajax': 'https://api.myjson.com/bins/1us28', //'{{ route("products.lov") }}',
         'columnDefs': [
            {
               'targets': 0,
               'checkboxes': {
                  'selectRow': true
               }
            }
         ],
         'select': {
            'style': 'multi'
         },
         'order': [[1, 'asc']]
      });
      
      // Handle form submission event 
      $('#frm-example').on('submit', function(e){
         var form = this;         
         var rows_selected = table.column(0).checkboxes.selected();
         // Iterate over all selected checkboxes
         $.each(rows_selected, function(index, rowId){
            // Create a hidden element 
            $(form).append(
                $('<input>')
                   .attr('type', 'hidden')
                   .attr('name', 'id[]')
                   .val(rowId)
            );
         });

         // FOR DEMONSTRATION ONLY
         // The code below is not needed in production
         
         // Output form data to a console     
         $('#example-console-rows').text(rows_selected.join(","));
         
         // Output form data to a console     
         $('#example-console-form').text($(form).serialize());
          
         // Remove added elements
         $('input[name="id\[\]"]', form).remove();
          
         // Prevent actual form submission
         e.preventDefault();
      });   
});
   </script>

   <script type="text/javascript">
       function () {
           $('#btn_product_list_modal').click(function() {
           $('.invoice').addClass('spinner');
           var $modal = $('#ajax-modal');
           $.get('{{ route("products.lov") }}', function(data) {
               $modal.modal();
               $modal.html(data);
               $('.invoice').removeClass('spinner');
               var t = $('.datatable').DataTable({
                   "columnDefs": [ {
                       "searchable": false,
                       "orderable": false,
                       "targets": 0
                   } ],
                   "order": [[ 1, 'asc' ]],
                   "bLengthChange": false,
                   "bInfo" : false,
                   "filter" : true,
                   'paging': true,
                   "oLanguage": { "sSearch": ""}
               });
               $('div.dataTables_filter input').addClass('form-control input-sm');
               $('[data-toggle="popover"]').popover();
           });
       });
       }
   </script>

@endpush

