@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('css')

@stop


@section('content')

{!!Form::open(array('route'=>'piutang.insert','id'=>'frmsave', 'class'=>'form-horizontal','method'=>'post'))!!}

<div class="row">
	<div class="col-xs-12">

		<div class="panel panel-default">
		
		<div class="panel-heading">
			Tambah Pembayaran Piutang
		</div>
		
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

		<div class="panel-body  table-responsive">	
                
                {!!Form::hidden('userid', Auth::user()->id )!!}

                <div class="form-group">
                {!! Form::label('akun_id', 'Akun Kas :', ['class' => 'col-sm-2 control-label']) !!} 
                <div class="col-sm-6">               
                {!! Form::select('akun_id', $akun_list, null, ['class' => 'form-control', 'placeholder' => 'Pilih Akun']) !!}                           
                </div>                
                <div class="form-group">
                <div class="col-sm-4">               
                {!! Form::checkbox('is_giro', 'Y', null, ['class' => 'flat']) !!} 
                <b>Giro</b>
                </div>
                </div>
                
            
                <div class="form-group"> 
                {!! Form::label('kontak_id', 'Penerima :', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                {!! Form::select('kontak_id', $kontak_list, old('no_po'), ['class' => 'form-control', 'placeholder' => 'Pilih Penerima']) !!}
                </div>

                {!! Form::label('no_reff', 'No. Referensi :', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                {!! Form::text('no_reff', $invoice, ['style'=>'background: #eee','class' => 'form-control', 'readonly' => 'true']) !!}
                </div>

                </div>

                
                  
                <div class="form-group">
	        <!--
                {!! Form::label('proyek', 'Proyek :', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                {!! Form::text('proyek', old('proyek'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
	        -->

                
                {!! Form::label('tanggal', 'Tanggal :', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal Faktur" value="01/03/2018">          
                </div>
                </div>

                <div class="form-group">
				
                {!! Form::label('departement_id', 'Departement :', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                {!! Form::select('departement_id', $departement_list, null, ['class' => 'form-control', 'placeholder' => 'Pilih Departement']) !!}
                </div>
                
                {!! Form::label('nilai', 'Sebesar :', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                {!! Form::text('nilai',  old('nilai'), ['class' => 'form-control nilai', 'placeholder' => '0.00', 'style'=>'text-align:right']) !!}
                </div>

                </div>

            <div class="form-group">   
                
                {!! Form::label('keterangan', 'Keterangan :', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                {!! Form::text('keterangan', old('keterangan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <p class="help-block"></p>
                @if($errors->has('keterangan'))
                <p class="help-block">
                      {{ $errors->first('keterangan') }}
                </p>
                @endif

            </div>

            

            <div class="form-group">
            <div class="col-md-12">
	        
            	<table class="table table-bordered">
	        		<thead>
	        			<th width="30">No Faktur</th>
	        			<th width="17">Tanggal</th>
	        			<th width="20">Saldo</th>
	        			<th width="10">Diskon</th>
	        			<th width="20">Jumlah Dibayar</th>
	        			<th width="3%" style="text-align: center;background: #eee"><a href="#" class="addRow" title="Tambah Baris"><i class="glyphicon glyphicon-plus"></i></a></th>
	        		</thead>
	        		<tbody>
	        			<tr id="item">
	        				<td width="15%">
                                <select class="form-control no_faktur" name="no_faktur[]" id="no_faktur">
                                <option value="0" selected="true" disabled="true">Pilih Faktur</option>
                                @foreach($faktur_list as $key => $p)    
                                <option value="{!!$key!!}">{!!$p!!}</option>
                                @endforeach
                                </select>
                            </td>                           
                            <td width="10%"><input type="text" id="date_add" name="date_add[]" class="form-control date_add"></td>
	        				<td width="10%"><input type="text" id="saldo" name="saldo[]" class="form-control saldo" style="text-align: right;"></td>
	        				<td width="5%"><input type="text" id="diskon" name="diskon[]" style="text-align: right;" class="form-control diskon"></td>
	        				<td width="10%"><input type="text" id="jml_dibayar" name="jml_dibayar[]" style="text-align: right;" class="form-control jml_dibayar" placeholder="0.00"></td>
	        				<!--<td width="8%"><input type="text" name="uom_id[]" class="form-control uom_id"></td>
	        				<td width="10%"><input type="text" name="harga[]" style="text-align: right;" class="form-control harga"></td>
	        				<td width="5%"><input type="text" name="discount[]" style="text-align: center;" class="form-control discount"></td>
	        				<td width="10%"><input type="text" name="amount[]" style="text-align: right; background: #eee;" class="form-control amount" readonly="true"></td>
	        				<td width="6%"><input type="text" name="pajak[]" style="text-align: center;"  class="form-control pajak"></td>
                            <td width="5%"><input  type="text" name="proyek2[]" class="form-control proyek2"></td>
                            <td width="5%"><input  type="hidden" name="proyek1[]" class="form-control proyek1"></td>
	        				-->
                            <td width="3%" style="text-align: center;"  width="5%"><a  href="#" class="btn btn-sm btn-danger remove"><i  class="glyphicon glyphicon-minus"></i></a></td>
                            
	        			</tr>
	        		</tbody>
                    

                    
	        		<tfoot>
	        			<tr>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td colspan="2" style="text-align: right; vertical-align: middle; border: none;" ><label><p>Denda :</p></label></td>
                            <td colspan="3" style="text-align: right; border: none;"><input type="text"  style="text-align: right;"  name="denda" placeholder="0.0" class="form-control denda"></td>                          
                        </tr>

                        <!--
                        <tr>
                            <td colspan="2" style="border: none;">
                            Tgl. Pengiriman :</br>
                            <input type="text" class="form-control" name="tanggal_kirim" id="tanggal_kirim" placeholder="Tanggal Kirim" value="01/03/2018">
                            </td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td colspan="2" style="text-align: right; border: none;"><b>Total Pajak</b></td>
                            <td colspan="3" style="text-align: right; border: none;"><b class="totalpajak"></b></td>                          
                        </tr>
                        <tr>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td colspan="2" style="text-align: right;border: none;"><b>Total Setelah Pajak</b></td>
                            <td colspan="3" style="text-align: right;border: none;"><b class="total_setelah_pajak"></b></td>                          
                        </tr>
                        <tr>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td colspan="2" style="text-align: right;border: none;"><b>Uang Muka</b></td>
                            <td colspan="3" style="text-align: right;border: none;"><b class="total"></b></td>                          
                        </tr>
                        <tr>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td style="border: none;"></td>
                            <td colspan="2" style="text-align: right;border: none;"><b>Saldo Terutang</b></td>
                            <td colspan="3" style="text-align: right;border: none;"><b class="total"></b></td>                          
                        </tr>
	        		</tfoot>
                    -->
	        	

                </table>
                
            </div>
            </div>

    </div>
    </div>	


        <div class="col-lg-2 col-sm-2">
            <div class="form-group">
                <a href="{{route('piutang.index')}}" class="btn btn-primary">Batal</a>
                {!!Form::submit('Rekam', array('class'=>'btn btn-primary'))!!}
            </div>  
        </div>	

        <div class="form-group">
            <!--
            <input type="checkbox" name="is_cetak[]" value="Y" class="flat"> <label><b> Cetak</b></label>
            <input type="checkbox" name="is_tunai[]" value="Y" class="flat"> <label><b> Tunai</b></label>
            -->
            
            {!! Form::checkbox('is_cetak', 'Y', null, ['class' => 'flat']) !!}
            {!! Form::label('is_cetak', ' Cetak', ['class' => 'control-label']) !!}

            <!--
            {!! Form::checkbox('is_tunai', 'Y', null, ['class' => 'flat']) !!}
            {!! Form::label('is_tunai', ' Tunai', ['class' => 'control-label']) !!}
            -->


        </div>  
        
        

        <!--
        <div class="form-group">
          <label for="is_cetak" class="col-sm-3 control-label">Bebas SPP</label>
          <div class="col-sm-9">
            <input type="checkbox" name="is_cetak" value="1" class="flat-red"  >
          </div>
        </div>
        -->

</div>


{!! Form::close() !!}	
@stop

@push('javascripts')

<!--
<script src="{{ asset('js/jquery-1.7.2.min.js') }}"></script>  
--> 

    <script type="text/javascript">
        $(document).ready(function() {
            $("#tanggal").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        })
        });
    </script>       

    <script type="text/javascript">

        $('tbody').delegate('.no_faktur','change',function(){
            var tr = $(this).parent().parent();
            var id = tr.find('.no_faktur').val();
            var dataId = {'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('piutang.findTanggal')!!}',
                dataType: 'json',
                data    : dataId,                
                success:function(data){
                    tr.find('.date_add').val(data.tanggal_faktur);
                }
            });
        });
       
        $('tbody').delegate('.no_faktur','change',function(){            
            var tr=$(this).parent().parent();
            var id = tr.find('.no_faktur').val();
            var kontak_id = document.getElementById("kontak_id").value;
            var dataId = {
                          'id':id,
                          'kontak_id':kontak_id
                         };
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('piutang.findPrice')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    tr.find('.saldo').val(data.saldohutang.formatMoney(0,'.',','));
                }
            });
        });

        /*
        $('tbody').delegate('.no_faktur','change',function(){  
            //alert('1');          
            var tr=$(this).parent().parent();
            var id = tr.find('.no_faktur').val();
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('piutang.findPrice')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    tr.find('.saldo').val(data.saldo);
                }
            });
        });
        */

        $('tbody').delegate('.no_faktur','change',function(){
            //alert('sadsad');
            var tr=$(this).parent().parent();
            tr.find('.diskon').focus();
        });

        $('tbody').delegate('.jml_dibayar', 'keyup',function(){
            //alert('sadsad');
            //var tr=$(this).parent().parent();
            //tr.find('.diskon').focus();
            total();
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
            calcTotals();
        });

        $('tbody').delegate('.qty,.harga,.discount,.pajak', 'keyup',function(){
            //alert('pajak :');
            var tr =$(this).parent().parent();
            var amount =tr.find('.amount').val();
            var pajak =tr.find('.pajak').val();
            
            var pajakrp = amount * (pajak/100);
            tr.find('.proyek1').val(pajakrp);
            //alert(pajakrp);

            total();
            totalpajak();
            totalsetelahpajak();
            calcTotals();
        });

        $('body').delegate('.biaya_lain','keyup', function(){
            //alert($(this).val());
            var biaya_lain = $(this).val();
            $('.biaya_lain').val("Rp. "+biaya_lain.formatMoney(2,'.',','));
        });

        $('.addRow').on('click',function(){
            addRow();
        });

                
        function total()
        {
            var total =0;
            $('.jml_dibayar').each(function(i,e){
                var jml_dibayar = $(this).val()-0;
                total +=jml_dibayar;
            })
            //$('.total').html("Rp. "+total.formatMoney(2,'.',','));
            $('.nilai').val("Rp. "+total.formatMoney(2,'.',','));
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
            $('.jml_dibayar').each(function(i,e){
                var jml_dibayar = $(this).val()-0;
                total +=jml_dibayar;
            });

           // var biaya = $(this).find("[name='biaya_lain']").val();

            totalsetelahpajak = total + totalpajak;// + biaya;
            $('.totalsetelahpajak').html("Rp. "+totalsetelahpajak.formatMoney(2,'.',','));
            $('.totalsetelahpajak').val("Rp. "+totalsetelahpajak.formatMoney(2,'.',','));
            $('.saldo_terutang').val("Rp. "+totalsetelahpajak.formatMoney(2,'.',','));
        };

        function calcTotals(){
            var amount2     = 0;
            var totalamount = 0;
            var totalpajak  = 0;
            var totalsetelahpajak       = 0;

            $('.tr.item').each(function(){
                var qty = parseFloat($(this).find("[name='qty']").val());
                var harga = parseFloat($(this).find("[name='harga']").val());
                var discount = parseFloat($(this).find("[name='discount']").val());
                var pajak = parseFloat($(this).find("[name='pajak']").val());
                var itemTotal = parseFloat(qty * harga) > 0 ? parseFloat(qty * harga) : 0;

                subTotal  += parseFloat(harga * qty) > 0 ? parseFloat(harga * qty) : 0;
                totalTax  += parseFloat(harga * qty * pajak/100) > 0 ? parseFloat(harga * qty * pajak/100) : 0;

            });



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
            var tr =  '<tr id="item">'+
                        '<td width="15%">'+
                        '<select class="form-control no_faktur" name="no_faktur[]" id="no_faktur">'+
                        '<option value="0" selected="true" disabled="true">Pilih Faktur</option>'+
                        '@foreach($faktur_list as $key => $p)'+   
                        '<option value="{!!$key!!}">{!!$p!!}</option>'+
                        '@endforeach'+
                        '</select>'+
                        '</td>'+                           
                        '<td width="10%"><input type="text" name="date_add[]" class="form-control date_add"></td>'+
                        '<td width="10%"><input type="text" name="saldo[]" class="form-control saldo" style="text-align: right;"></td>'+
                        '<td width="5%"><input type="text" name="diskon[]" style="text-align: right;" class="form-control diskon"></td>'+
                        '<td width="10%"><input type="text" name="jml_dibayar[]" style="text-align: right;" class="form-control jml_dibayar" placeholder="0.00"></td>'+
                        '<td width="3%" style="text-align: center;"  width="5%"><a  href="#" class="btn btn-sm btn-danger remove"><i  class="glyphicon glyphicon-minus"></i></a></td>'+
                        '</tr>';
            $('tbody').append(tr);               
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
            totalpajak();
            totalsetelahpajak();
            }
        });

        /*
        function number(input){
            $(input).keypress(function(evt){
                var theEvent = evt || window.event;
                var key = thead.keyCode || theEvent.which;
                key = String.fromCharCode( key );
                var regex = /[-\d\.]/;
                var objRegex = /^-?\d*[\.]?\d*$/;
            });
        };
        */
    </script>
@endpush

