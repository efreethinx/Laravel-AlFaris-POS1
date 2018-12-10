@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('css')

@stop


@section('content')

{!!Form::open(array('route'=>'kas.penerimaan.insert','id'=>'frmsave', 'class'=>'form-horizontal', 'method'=>'post'))!!}

<div class="row">
	<div class="col-xs-12">

		<div class="panel panel-default">
		
		<div class="panel-heading">
		     Input Penerimaan Kas
		</div>
	
		<div class="panel-body">

        	<div class="form-group">                
                {!! Form::label('akun_id', 'Akun Kas :', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-3">
                {!! Form::select('akun_id', $akun_list, old('akun_id'), ['class' => 'form-control', 'placeholder' => 'Pilih Akun Kas']) !!}
                </div>
            </div>
            
            <div class="form-group">  
                {!! Form::label('kontak_id', 'Dibayar Kepada :', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-3">
                {!! Form::select('kontak_id', $kontak_list, old('kontak_id'), ['class' => 'form-control', 'placeholder' => 'Pilih Penerima']) !!}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('no_cek', 'No. Cek :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-3">
                {!! Form::text('no_cek', $invoice, ['style'=>'background: #eee','class' => 'form-control', 'readonly' => 'true']) !!}
                </div>

                {{ Form::label('proyek', 'Proyek : ', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-3">
                {!! Form::text('proyek', old('proyek'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>               
            </div>	

            <div class="form-group">
                {!! Form::label('tanggal', 'Tanggal :', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-3">
                <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal Faktur" value="01/03/2018">                
                </div>
                {!! Form::label('departement_id', 'Departement :', array('class' => 'col-sm-2 control-label')) !!}
                <div class="col-sm-3">
                {!! Form::select('departement_id', $departement_list, old('departement_id'), ['class' => 'form-control', 'placeholder' => 'Pilih Departement']) !!}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('nilai', 'Sebesar : ', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-3">
                <!--
                {!! Form::text('nilai', old('nilai'), ['style'=>'text-align:right;','class' => 'form-control nilai', 'placeholder' => '0.00']) !!}
                -->
                <input type="text" name="nilai" id="nilai" class="form-control nilai" placeholder="0.00" style="text-align: right;background: #eee">
                </div>                
            </div>
            
            <div class="form-group">                
                {!! Form::label('keterangan', 'Memo :', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8">    
            {!! Form::text('keterangan', old('keterangan'), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>
            </div>
                

           

            <div class="form-group">
            <div class="col-md-12">
	        
            	<table class="table table-bordered">
	        		<thead>
	        			<th>Kode</th>
	        			<th>Nama Akun</th>
	        			<th>Dept.</th>
	        			<th class="text-right">Nilai(Dr)</th>
	        			<th>Job</th>
	        			<th width="5%" style="text-align: center;background: #eee"><a href="#" class="addRow" title="Tambah Baris"><i class="glyphicon glyphicon-plus"></i></a></th>
	        		</thead>
	        		<tbody>
	        			<tr id="item">
	        				<td width="18%"><input type="text" name="kode_akun[]" class="form-control kode_akun"></td>
	        				<td width="25%">
	        					<select class="form-control nama_akun2" name="nama_akun2[]" id="nama_akun2">
	        					<option value="0" selected="true" disabled="true">Pilih Akun</option>
	        					@foreach($akun_list as $key => $p)	
	        					<option value="{!!$key!!}">{!!$p!!}</option>
	        					@endforeach
	        					</select>
	        				</td>	        				
	        				<td width="20%">
	        					<select class="form-control departement_id2" name="departement_id2[]" id="departement_id2">
	        					<option value="0" selected="true" disabled="true">Pilih Dept.</option>
	        					@foreach($departement_list as $key => $p)	
	        					<option value="{!!$key!!}">{!!$p!!}</option>
	        					@endforeach
	        					</select>
	        				</td>
	        				<td width="15%"><input style="text-align: right;" type="text" name="jml_keluar[]" class="form-control jml_keluar" placeholder="0.00"></td>
	        				<td width="15%"><input type="text" name="job[]" class="form-control job"></td>
                            <td width="2%" style="text-align: center;"  width="5%"><a  href="#" class="btn btn-danger remove"><i  class="glyphicon glyphicon-minus"></i></a></td>                           
	        			</tr>
	        		</tbody>

                </table>
                
            </div>
            </div>

            </div>


    </div>
    </div>	


        <div class="col-lg-2 col-sm-2">
            <div class="form-group">
                <a href="{{route('kas.penerimaan.index')}}" class="btn btn-primary">Batal</a>
                {!!Form::submit('Rekam', array('class'=>'btn btn-primary'))!!}
            </div>  
        </div>	

        <div class="form-group">
            <!--
            <input type="checkbox" name="is_cetak[]" value="Y" class="flat"> <label><b> Cetak</b></label>
            <input type="checkbox" name="is_tunai[]" value="Y" class="flat"> <label><b> Tunai</b></label>
            -->
            
            {!! Form::checkbox('is_cetak', '1', null, ['class' => 'flat']) !!}
            {!! Form::label('is_cetak', ' Cetak', ['class' => 'control-label']) !!}

            
            {!! Form::checkbox('is_giro', '1', null, ['class' => 'flat']) !!}
            {!! Form::label('is_giro', ' Giro', ['class' => 'control-label']) !!}


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
             // set an element
             //$("#date").val(moment().format('dd-mm-yyyy'));
             // set a variable
             //var today = moment().format('dd-mm-yyyy');
            $("#tanggal").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        })
        //.on("changeDate", function(e) {
            // Revalidate the date field
          //  $("#frmData").formValidation("revalidateField", "tanggal_faktur");
        //});
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
             // set an element
             //$("#date").val(moment().format('dd-mm-yyyy'));
             // set a variable
             //var today = moment().format('dd-mm-yyyy');
            $("#tanggal_kirim").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        })
        //.on("changeDate", function(e) {
            // Revalidate the date field
          //  $("#frmData").formValidation("revalidateField", "tanggal_kirim");
        //});
        });
    </script>

        

    <script type="text/javascript">

        $('tbody').delegate('.nama_akun2','change',function(){   
        	//alert('xxx');         
            var tr=$(this).parent().parent();
            var id = tr.find('.nama_akun2').val();
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('kas.penerimaan.findKodeProduk')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    tr.find('.kode_akun').val(data.kode_akun);
                }
            });
        });

        $('tbody').delegate('.nama_akun2','change',function(){            
            var tr=$(this).parent().parent();
            var id = tr.find('.nama_akun2').val();
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('kas.penerimaan.findSatuan')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    tr.find('.uom_id').val(data.uom_id);
                }
            });
        });
        
        $('tbody').delegate('.nama_akun2','change',function(){            
            var tr=$(this).parent().parent();
            var id = tr.find('.nama_akun2').val();
            var dataId={'id':id};
            $.ajax({
                type    : 'GET',
                url     : '{!!URL::route('kas.penerimaan.findPrice')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    tr.find('.harga').val(data.harga_jual_satuan);
                }
            });
        });

        $('tbody').delegate('.nama_akun2','change',function(){
            //alert('sadsad');
            var tr=$(this).parent().parent();
            tr.find('.departement_id2').focus();
        });

        $('tbody').delegate('.jml_keluar', 'keyup',function(){
            //alert('sadsad');
            //var tr =$(this).parent().parent();
            total();
      
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
            $('.jml_keluar').each(function(i,e){
                var jml_keluar = $(this).val()-0;
                total +=jml_keluar;
            })
            //$('.total').html("Rp. "+total.formatMoney(2,'.',','));
            $('.nilai').val("Rp. "+total.formatMoney(2,'.',','));
            //tr.find('.nilai').val("Rp. "+total.formatMoney(2,',','.'));
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

           // var biaya = $(this).find("[name='biaya_lain']").val();

            totalsetelahpajak = total - totalpajak;// + biaya;
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
                      '<td width="18%"><input type="text" name="kode_akun[]" class="form-control kode_akun"></td>'+
	        				'<td width="25%">'+
	        					'<select class="form-control nama_akun2" name="nama_akun2[]" id="nama_akun2">'+
	        					'<option value="0" selected="true" disabled="true">Pilih Akun</option>'+
	        					'@foreach($akun_list as $key => $p)	'+
	        					'<option value="{!!$key!!}">{!!$p!!}</option>'+
	        					'@endforeach'+
	        					'</select>'+
	        				'</td>'+	        				
	        				'<td width="20%">'+
	        					'<select class="form-control departement_id2" name="departement_id2[]" id="departement_id2">'+
	        					'<option value="0" selected="true" disabled="true">Pilih Dept.</option>'+
	        					'@foreach($departement_list as $key => $p)'+	
	        					'<option value="{!!$key!!}">{!!$p!!}</option>'+
	        					'@endforeach'+
	        					'</select>'+
	        				'</td>'+
	        				'<td width="15%"><input style="text-align: right;" type="text" name="jml_keluar[]" class="form-control jml_keluar" placeholder="0.00"></td>'+
	        				'<td width="15%"><input type="text" name="job[]" class="form-control job"></td>'+
                            '<td width="2%" style="text-align: center;"  width="5%"><a  href="#" class="btn btn-danger remove"><i  class="glyphicon glyphicon-minus"></i></a></td>'+                           
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

