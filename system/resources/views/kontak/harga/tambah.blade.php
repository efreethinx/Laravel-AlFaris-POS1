



@extends('layouts.app')

@push('css')
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.19/themes/ui-lightness/jquery-ui.css') }}" rel="stylesheet"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.19/jquery-ui.min.js') }}"></script> 
<style type="text/css">
    .warna-text {
        color: #FFFFFF;
    }
</style>
@endpush

@section('content-header')
      <h1>
        @lang('global.hargajuals.title')
        <small>Add</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('kontak')}}"> @lang('global.hargajuals.title')</a></li>
        <li class="active">@lang('global.app_create')</li>
      </ol>    
@stop

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['hargajuals.store'],'class' => 'form-horizontal']) !!}

<div class="row">

<div class="col-xs-12">

    <div class="panel panel-default">
        
        <div class="panel-heading">
            Setup Harga Jual Pelanggan 
        </div>

         @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
         @endif

        <div class="panel-body table-responsive">  

                <div class="form-group">
                {{ Form::label('nama_kontak', 'Nama Pelanggan *', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-6">
                <div class="input-group">
                {{ Form::hidden('kontak_id', null, array('id'=>'kontak_id', 'class' => 'form-control')) }}
                {{ Form::text('nama_kontak', null, array('class' => 'form-control', 'placeholder'=>'Nama Pelanggan')) }}
                <span class="input-group-btn">
                <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#myModalKontak" data-backdrop="static" data-keyboard="false">Cari</button>
                </span>
                </div>                
                </div>                
                </div>   
                
                <div class="form-group">

                {{ Form::label('data_produk', 'Data Produk :', array('class' => 'col-sm-2 control-label')) }}

                <div class="col-md-12">     
                <br>       
                <table class="table table-no-bordered table-responsive" id="item_table">
                    <thead style="background: #696969;">
                        <th class="warna-text"><b>Kode</b></th>
                        <th class="warna-text">Deskripsi Produk</th>
                        <th class="warna-text">Satuan</th>
                        <th class="warna-text" style="text-align: right;">Harga Jual Standar</th>
                        <th class="warna-text" style="text-align: right;">Harga Jual Pelanggan</th>
                        <th width="5%" style="text-align: center;background: #eee"><a href="#" class="addRow" title="Tambah Baris"><i class="glyphicon glyphicon-plus"></i></a></th>
                    </thead>
                    <tbody style="background: #eee;" class="item_body">
                        <tr class="item">
                            <td width="15%">
                            <input type="hidden" name="produk_id[]" class="form-control input-sm produk_id" id="produk_id" readonly="true">
                            <input type="text" name="kode_produk[]" class="form-control input-sm kode_produk" id="kode_produk" readonly="true">
                            </td>
                            <td width="25%">
                             <div class="input-group">
                             <input type="text" name="nama_produk[]" class="form-control input-sm nama_produk" id="nama_produk">
                             <span class="input-group-btn">
                             <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Cari</button> 
                             </span>
                             </div>
                            </td> 
                            <td width="15%">
                                <select class="form-control input-sm uom_id" name="uom_id[]" id="uom_id">
                                <option value="0" selected="true" disabled="true">Pilih Satuan</option>
                                @foreach($uoms_list as $key => $p)   
                                <option value="{!!$key!!}">{!!$p!!}</option>
                                @endforeach
                            </td> 
                           
                            <td width="20%">
                            <input type="text" name="harga_jual_standar[]" style="text-align: right;" class="form-control input-sm harga_jual_standar" id="harga_jual_standar">
                            </td>
                            <td width="20%"><input type="text" name="harga_jual_pelanggan[]" style="text-align: right;" class="form-control input-sm" id="harga_jual_pelanggan">
                            </td>

                            
                            <td width="5%" style="text-align: center;">&nbsp;&nbsp;</td>
                            
                            
                        </tr>
                    </tbody>                

                </table>   

                </div> 

                <div class="form-group">
                    {!! Form::label('situs', '&nbsp;', ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                    <div class="btn-group pull-right">
                    <a href="{{URL('kontak/hargajuals')}}" class="btn btn-primary"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
                    <button type="submit" class="btn btn-success" id="btnSubmit" style="margin-left: 5px;">
                    <i class="fa fa-check fa-fw"></i> Save</button>
                    </div>    
                    </div>
                </div>    
                

        </div>

            
        
    </div>

    <div class="panel-footer">&nbsp;</div>

    </div>
</div>

{!! Form::close() !!}


      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Daftar Kepala Desa</h4>
            </div>
            <div class="modal-body">
              
              

              <div class="table-responsive">
                    
                  <div class="row">
                    <div class="col-md-12">
                        <div class="grid simple ">
                            <div class="grid-title no-border">
                                <h4>Data  <span class="semi-bold">Kepala Desa</span></h4>
                                <div class="tools"> <a href="javascript:;" class="collapse"></a>
                                    <a href="#grid-config" data-toggle="modal" class="config"></a>
                                    <a href="javascript:;" class="reload"></a>
                                    <a href="javascript:;" class="remove"></a>
                                </div>
                            </div>
                            <div class="grid-body no-border">
                                  <!--
                                  <h3>Pilih  <span class="semi-bold">Kepala Desa</span></h3>
                                  -->
                                    <table id="example3" class="table no-more-tables">
                                        <thead>
                                            <tr>
                                                <th style="width:1%" >
                                                    #
                                                </th>
                                                <th style="width:15%">Kode Produk</th>
                                                <th style="width:35%">Nama Produk</th>
                                                <th style="width:25%;text-align: right;">Harga Jual Standar</th>
                                                <th style="width:24%;text-align: right;">Stok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                  @foreach($product_list as $data)
                  <tr class="produk">
                    <?php
                    /*
                    $kec = DB::table('indonesia_districts')->where('id',$data->kecamatan)->first();
                    $kel = DB::table('indonesia_villages')->where('id',$data->desa)->first();

                    if ($data->jns_kelamin == 0) {
                        $gender = 'Laki - laki';
                    }else{
                        $gender = "Perempuan";
                    }

                    if ($data->aktif == 0) {
                        $active = 'Ya';
                    }else{
                        $active = "Tidak";
                    }

                    $values = $data->tgl_pelantikan;
                    $ddd    = Carbon\Carbon::parse($values)->format('d-m-Y');
                    
                    $value = $data->tgl_amj;
                    $dd    = Carbon\Carbon::parse($value)->format('d-m-Y');
                    */
                    
                    $id = $data->id;

                    ?>
                    <td class="v-align-middle">
                        <div>
                          <!--
                          <input type="hidden" name="idx" id="idx" value="{{ $data->id }}">
                          -->
                          <input id="checkbox{{ $data->id }}" type="checkbox" name="produk_id" value="{{ $data->id }}">
                          <label for="checkbox{{ $data->id }}"></label>
                        </div>
                    </td>
                    <td class="v-align-middle">{{ $data->kode_produk }}</td>
                    <td class="v-align-middle">{{ $data->nama_produk }}</td>
                    <th class="v-align-middle" style="text-align: right;">{{ $data->harga_jual_satuan }}</th>
                    <th class="v-align-middle" style="text-align: right;">{{ $data->stok }}</th>
                  </tr>
                @endforeach                         
                </tbody>
                </table>
                </div>
                </div>
                </div>
                </div>
              </div>
              <!-- end table-responsive -->
              
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-success" id="btn" value="Pilih Produk"/>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /Modal -->

@include('kontak.modalkontak')      

@stop

@push('javascripts')

<script type="text/javascript" src="{{ asset('js/kades.js')}}"></script>

<script>
    document.getElementById('btn').onclick = function()
        {
          // declarare variables
          var tr = $(this).parent().parent();  
          var checkbox = document.getElementsByName('produk_id');
          var result = "";                
          // loop each checkbox to get value
          for (var i = 0; i < checkbox.length; i++){
               if (checkbox[i].checked === true){
                   result += checkbox[i].value;
               }
          }              
          // Show result
                
          var id = result;          
          var dataId={'id':id};

          $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('hargajuals.findProduk')!!}',
                dataType: 'json',
                data    : dataId,
                success : function(data){

                    var products = data.products;

                    for(var key in products) {
                        //noinspection JSJQueryEfficiency
                        var last_row = $('#item_table tr:last');
                        //var xxx = last_row.find('input[id=nama_produk]').val();
                        if (last_row.find('input[id=nama_produk]').val() !== '')
                        {
                            //addRow('item_table');
                            //var last_row = $('#item_table tr:last');
                            last_row.find('input[id=nama_produk]').val(products[key].nama_produk);
                            last_row.find('input[id=produk_id]').val(products[key].id);
                            last_row.find('input[id=kode_produk]').val(products[key].kode_produk);
                            last_row.find('input[id=harga_jual_standar]').val(products[key].harga_jual_satuan);
                            //last_row.find('input[name=quantity]').val('1');
                        }
                        else
                        {
                            last_row.find('input[id=nama_produk]').val(products[key].nama_produk);
                            last_row.find('input[id=produk_id]').val(products[key].id);
                            last_row.find('input[id=kode_produk]').val(products[key].kode_produk);
                            last_row.find('input[id=harga_jual_standar]').val(products[key].harga_jual_satuan);
                            //last_row.find('input[name=quantity]').val('1');
                        }
                        $('#myModal').modal('hide').reset();
                        
                    }

                }
          });

        };
</script>


<script>
    document.getElementById('btn_kontak').onclick = function()
        {
          // declarare variables
          var checkbox = document.getElementsByName('kontak_id');
          var result = "";                
          // loop each checkbox to get value
          for (var i = 0; i < checkbox.length; i++){
               if (checkbox[i].checked === true){
                   result += checkbox[i].value;
               }
          }              
          // Show result
          //alert("kontak_id : " + result);          
          var id = result;          
          var dataId={'id':id};

          $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('hargajuals.findKontak')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    //alert(data.nama_kontak+' '+data.id);
                    //tr.find('.nama_kades').val(data.nama_kades);
                    $('#nama_kontak').val(data.nama_kontak);
                    //$('#kecamatan').val(data.kecamatan);
                    //$('#desa').val(data.desa);
                    $('#kontak_id').val(data.id);
                    //$('#jns_kelamin').val(data.jns_kelamin);
                    //$('#tgl_pelantikan').val(data.tgl_pelantikan);
                    //$('#tgl_amj').val(data.tgl_amj);
                    //$('#no_kontak').val(data.no_kontak);
                    $('#myModalKontak').modal('hide');
                }
          });

        };
</script>

    <script type="text/javascript">

        $('tbody').delegate('.nama_produk','change',function(){            
            var tr=$(this).parent().parent();
            var id = tr.find('.nama_produk').val();
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('pembelian.findKodeProduk')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    tr.find('.kode_produk').val(data.kode_produk);
                }
            });
        });

        $('tbody').delegate('.nama_produk','change',function(){            
            var tr=$(this).parent().parent();
            var id = tr.find('.nama_produk').val();
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('pembelian.findPrice')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    tr.find('.harga').val(data.harga_jual_satuan);
                }
            });
        });
        
        /*
        $('tbody').delegate('.nama_produk','change',function(){       
            var tr=$(this).parent().parent();
            var id = tr.find('.nama_produk').val();
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('pembelian.findUoms')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    alert(data.uom_id);
                    tr.find('.uom_id').val(data.uom_id);
                    //$data =  tr.find('.uom_id').val(data.uom_id);

                }
            });
        });
        
        
        $('tbody').delegate('.nama_produk','change',function(){            
            $.get("{{ url('api/getregency')}}", { option: $('#kode_produk').val() }, 
               function(data) {
               var numbers = $('#uom_id');
                   numbers.empty();
                   $.each(data, function(key, value) {   
                   numbers .append($("<option></option>")
                           .attr("value",key)
                           .text(value)); 
                    });
                });
        });
        */

        $('tbody').delegate('.nama_produk','change',function(){
            //alert('sadsad');
            var tr=$(this).parent().parent();
            tr.find('.qty').focus();
        });

        $('tbody').delegate('.qty,.harga,.discount', 'keyup',function(){
            //alert('sadsad');
            
            var tr =$(this).parent().parent();
            var qty =tr.find('.qty').val();
            var harga =tr.find('.harga').val();
            var discount =tr.find('.discount').val();
            var amount = (qty * harga) - (qty * harga * discount)/100;
            tr.find('.amount').val(amount);

            total();
            totalpajak();
            totalsetelahpajak();
            //calcTotals();
        });

        $('tbody').delegate('.qty,.harga,.discount,.pajak', 'keyup',function(){
            //alert('pajak : ' totalpajak());
            var tr =$(this).parent().parent();
            var amount = tr.find('.amount').val();
            var pajak  = tr.find('.pajak').val();
            
            var pajakrp = amount * (pajak/100);
            tr.find('.proyek1').val(pajakrp);
            //alert(pajakrp);

            total();
            //total2();
            totalpajak();
            totalsetelahpajak();
            //calcTotals();
        });

        $('body').delegate('.qty,.harga,.discount,.pajak,.biaya_lain','keyup', function(){
            
            var x = document.getElementById("totalsetelahpajak2").value;            
            var biaya_lain = document.getElementById("biaya_lain").value;
            total22 = parseInt(x) + parseFloat(biaya_lain); 

            $('.totalsetelahpajak').val("Rp. "+total22.formatMoney(2,'.',','));
            $('.totalsetelahpajak3').val(total22);
            
        });


        $('body').delegate('.qty,.harga,.discount,.pajak,.biaya_lain,.uang_muka','keyup', function(){
            


            var m = document.getElementById("totalsetelahpajak3").value;            
            var uang_muka = document.getElementById("uang_muka").value;   

            //alert(m + uang_muka);

            saldo_terutang = parseInt(m) - parseFloat(uang_muka); 

            $('.saldo_terutang').val("Rp. "+saldo_terutang.formatMoney(2,'.',','));
            
        });

        $('.addRow').on('click',function(){
            addRow();
        });

        function total2()
        {
            var x = document.getElementById("totalsetelahpajak2").value;            
            var biaya_lain = $(this).val();

            total22 = parseInt(x) + parseInt(biaya_lain);

            $('.totalsetelahpajak').val("Rp. "+total22.formatMoney(2,'.',','));
            
        };        

        function total()
        {
            var total =0;
            $('.amount').each(function(i,e){
                var amount = $(this).val()-0;
                total +=amount;
            })
            $('.total').html("Rp. "+total.formatMoney(2,'.',','));
            //$('.saldo_terutang').val(total);
            //tr.find('.subtotal').val("Rp. "+total.formatMoney(2,',','.'));
        };
        
        
        function totalpajak()
        {   
            var totalpajak =0;
            $('.proyek1').each(function(i,e){
                var proyek1 = $(this).val()-0;
                totalpajak +=proyek1;                
            })       

            $('.totalpajak').html("Rp. "+totalpajak.formatMoney(2,'.',','));
            $('.totalpajak').val("Rp. "+totalpajak.formatMoney(2,'.',','));
        };

        function totalsetelahpajak(){
            //var total = total();
            var totalsetelahpajak = 0;
            
            var totalpajak =0;
            $('.proyek1').each(function(i,e){
                var proyek1 = $(this).val()-0;
                totalpajak +=proyek1;
            });

            var total =0;
            $('.amount').each(function(i,e){
                var amount = $(this).val()-0;
                total +=amount;
            });
            
            totalsetelahpajak = total + totalpajak;
            $('.totalpajak').html("Rp. "+totalpajak.formatMoney(2,'.',','));
            $('.totalsetelahpajak').val("Rp. "+totalsetelahpajak.formatMoney(2,'.',','));
            $('.totalsetelahpajak2').val(totalsetelahpajak);
            //$('.saldo_terutang').val("Rp. "+totalsetelahpajak.formatMoney(2,'.',','));
            //$('.uang_muka').val("Rp. "+totalsetelahpajak.formatMoney(2,'.',','));
        };

        //------------------formatMoney----------------
        Number.prototype.formatMoney = function(c, d, t){
        var n = this, 
            c = isNaN(c = Math.abs(c)) ? 2 : c, 
            d = d == undefined ? "." : d, 
            t = t == undefined ? "," : t, 
            s = n < 0 ? "-" : "", 
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
            j = (j = i.length) > 3 ? j % 3 : 0;
           return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
         };
        //---------------------------------------------
        
        function addRow()
        {
            var tr =  '<tr class="item">'+
                            '<td width="15%"><input type="hidden" name="produk_id[]" class="form-control input-sm produk_id" id="produk_id" readonly="true">'+
                            '<input style="background: #eee;" type="text" name="kode_produk[]" class="form-control input-sm kode_produk" id="kode_produk" readonly="true"></td>'+
                            '<td width="25%">'+
                             '<div class="input-group">'+
                             '<input type="text" name="nama_produk[]" class="form-control input-sm nama_produk" id="nama_produk">'+
                             '<span class="input-group-btn">'+
                             '<button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Cari</button>'+ 
                             '</span>'+
                             '</div>'+
                            '</td> '+ 
                            '<td width="15%">'+
                                '<select class="form-control input-sm uom_id" name="uom_id[]" id="uom_id">'+
                                '<option value="0" selected="true" disabled="true">Pilih Satuan</option>'+
                                '@foreach($uoms_list as $key => $p)'+   
                                '<option value="{!!$key!!}">{!!$p!!}</option>'+
                                '@endforeach'+
                            '</td>'+                           
                            '<td width="20%"><input type="text" name="harga_jual_standar[]" style="text-align: right;" class="form-control input-sm  harga_jual_standar" id="harga_jual_standar">'+
                            '</td>'+
                            '<td width="20%"><input type="text" name="harga_jual_pelanggan[]" style="text-align: right;" class="form-control input-sm"  id="harga_jual_pelanggan">'+
                            '</td>'+

                            '<td width="5%" style="text-align: center;"><a href="#" class="btn btn-danger btn-sm remove"><i class="glyphicon glyphicon-minus"></i></a></td>'+
                            
                        '</tr>';
            $('#item_table').append(tr);               
        };

        $(document).on('click', '.remove', function() {
            //$('.remove').live('click', function(){
            var l=$('tbody tr').length;
            if (l==1)
            {
                alert('Anda tidak bisa menghapus baris terakhir !');
            }else{
                $(this).parent().parent().remove();
            total();
            //total2();
            totalpajak();
            totalsetelahpajak();
            }
        });

    </script>

    <script type="text/javascript">
    var count = "1";
    function cloneRow(in_tbl_name)
    {
            var tbody = document.getElementById(in_tbl_name).getElementsByTagName("tbody")[0];
            // create row
            var row = document.createElement("tr");
            // create table cell 1
            var td1 = document.createElement("td");
            var strHtml1 = "<span class='btn btn-danger btn-xs delete_row'><i class='fa fa-minus'></i></span> ";
            td1.innerHTML = strHtml1.replace(/!count!/g,count);
            // create table cell 2
            var td2 = document.createElement("td");
            var strHtml2 = '<div class="form-group"><input class="form-control input-sm nama_produk" id="nama_produk" required="required" name="nama_produk" type="text"></div>';
            td2.innerHTML = strHtml2.replace(/!count!/g,count);
            // create table cell 4
            var td3 = document.createElement("td");
            var strHtml3 = '<div class="form-group"><input class="form-control input-sm calcEvent quantity" id="quantity" required="required" step="any" min="0" name="quantity" type="number"></div> ';
            td3.innerHTML = strHtml4.replace(/!count!/g,count);
            // create table cell 5
            var td4 = document.createElement("td");
            var strHtml4 = '<div class="form-group"><input class="form-control input-sm calcEvent price" id="price" required="required" step="any" min="0" name="price" type="number"></div> ';
            td4.innerHTML = strHtml5.replace(/!count!/g,count);
            // create table cell 6
            var td5 = document.createElement("td");
            var strHtml5 = '<div class="form-group"><select class="form-control input-sm calcEvent tax" id="tax" name="tax"><option value="" data-value="">None</option><option value="c356bc0a-bbaf-401a-9d76-5123d5a19859" selected="selected" data-value="12">IVA</option></select></div> ';
            td5.innerHTML = strHtml6.replace(/!count!/g,count);
            // append data to row
            row.appendChild(td1);
            row.appendChild(td2);
            row.appendChild(td3);
            row.appendChild(td4);
            row.appendChild(td5);
            // add to count variable
            count = parseInt(count) + 1;
            // append row to table
            tbody.appendChild(row);
            row.className = 'item';
            $('tr.item:last select').chosen({width:'100%'});
    }
    </script>


    <!-- page script $("#mydate").datepicker().datepicker("setDate", new Date()); -->
    <script type="text/javascript">
        $(document).ready(function(){
            advanceElements.init();
         });
    </script>
@endpush
