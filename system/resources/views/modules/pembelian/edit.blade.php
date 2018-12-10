@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('css')

@stop


@section('content')


{{ Form::model($pembelian, array('route' => array('pembelian.update', $pembelian->id))) }}

<div class="row">
    <div class="col-xs-12">

        <div class="panel panel-default">
        
        <div class="panel-heading">
            Faktur Pembelian
        </div>
        
        <div class="panel-body  table-responsive">  
        
            <div class="form-group">

                <div class="col-sm-3">
                {!! Form::label('kontak_id', 'Nama Pemasok :', ['class' => 'control-label']) !!}
                
                {!! Form::select('kontak_id', $kontak_list, null, ['class' => 'form-control', 'placeholder' => 'Pilih Pemasok']) !!}
                            
                </div>
                <p class="help-block"></p>
                @if($errors->has('kontak_id'))
                <p class="help-block">
                      {{ $errors->first('kontak_id') }}
                </p>
                @endif
                    
                <div class="col-sm-2">
                {!! Form::label('no_faktur', 'No. Faktur :', ['class' => 'control-label']) !!}
                {!! Form::text('no_faktur', old('no_po'), ['style'=>'background: #eee','class' => 'form-control', 'readonly' => 'true']) !!}
                </div>
                <p class="help-block"></p>
                @if($errors->has('no_faktur'))
                <p class="help-block">
                      {{ $errors->first('no_faktur') }}
                </p>
                @endif
                    
                <div class="col-sm-2">
                {!! Form::label('no_po', 'No. Pesanan :', ['class' => 'control-label']) !!}
                {!! Form::text('no_po', old('no_po'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <p class="help-block"></p>
                @if($errors->has('no_po'))
                <p class="help-block">
                      {{ $errors->first('no_po') }}
                </p>
                @endif

                <div class="col-sm-2">
                {!! Form::label('tanggal_faktur', 'Tanggal Faktur :', ['class' => 'control-label']) !!}
                <input type="text" class="form-control" name="tanggal_faktur" id="tanggal_faktur" placeholder="Tanggal Faktur" value="01/03/2018">                
                </div>
                <p class="help-block"></p>
                @if($errors->has('tanggal_faktur'))
                <p class="help-block">
                      {{ $errors->first('tanggal_faktur') }}
                </p>
                @endif

                <div class="col-sm-3">
                {!! Form::label('proyek', 'Proyek :', ['class' => 'control-label']) !!}
                {!! Form::text('proyek', old('proyek'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <p class="help-block"></p>
                @if($errors->has('proyek'))
                <p class="help-block">
                      {{ $errors->first('proyek') }}
                </p>
                @endif
            </div>
            
            <div class="form-group">                    
                <div class="col-sm-3">
                {!! Form::label('gudang_masuk_id', 'Masuk Ke Gudang :', ['class' => 'control-label']) !!}
                {!! Form::select('gudang_masuk_id', $gudang_list, null, ['class' => 'form-control', 'placeholder' => 'Pilih Gudang']) !!}
                </div>
                <p class="help-block"></p>
                @if($errors->has('gudang_masuk_id'))
                <p class="help-block">
                      {{ $errors->first('gudang_masuk_id') }}
                </p>
                @endif
                    
                <div class="col-sm-6">
                {!! Form::label('keterangan', 'Keterangan :', ['class' => 'control-label']) !!}
                {!! Form::text('keterangan', old('keterangan'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <p class="help-block"></p>
                @if($errors->has('keterangan'))
                <p class="help-block">
                      {{ $errors->first('keterangan') }}
                </p>
                @endif
                    
                <div class="col-sm-3">
                {!! Form::label('departement_id', 'Departement :', ['class' => 'control-label']) !!}
                <!--
                <select class="form-control departement_id" name="departement_id[]" id="departement_id">
                <option value="0" selected="true" disabled="true">Pilih Departement</option>
                @foreach($departement_list as $key => $k)   
                <option value="{!!$key!!}">{!!$k!!}</option>
                @endforeach
                </select>
                -->
                {!! Form::select('departement_id', $departement_list, null, ['class' => 'form-control', 'placeholder' => 'Pilih Departement']) !!}

                </div>
                <p class="help-block"></p>
                @if($errors->has('departement_id'))
                <p class="help-block">
                      {{ $errors->first('departement_id') }}
                </p>
                @endif
            </div>

            <div class="text-right">
                <div class="form-group style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>

            <div class="form-group">
            <div class="col-md-12">
            
                <table class="table table-bordered">
                    <thead>
                        <th>Kode</th>
                        <th>Deskripsi Produk</th>
                        <th>Kode Akun</th>
                        <th>Diterima</th>
                        <th>Dipesan</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Total</th>
                        <th>Pajak</th>
                        <th>Proyek</th>
                        <th width="5%" style="text-align: center;background: #eee"><a href="#" class="addRow" title="Tambah Baris"><i class="glyphicon glyphicon-plus"></i></a></th>
                    </thead>
                    <tbody>
                    @foreach($pembelian_detail as $value)
                        <tr>
                        <td width="8%"> <!--
                        <input type="text" name="kode_produk[]" class="form-control kode_produk"> -->
                        {{ Form::text('kode_produk[]', old('kode_produk'), array('class' => 'form-control kode_produk')) }}
                        </td>
                            <td width="20%">
                                <select class="form-control nama_produk" name="nama_produk[]" id="nama_produk">
                                <option value="0" selected="true" disabled="true">Pilih Produk</option>
                                @foreach($product_list as $key => $p)   
                                <option value="{!!$key!!}">{!!$p!!}</option>
                                @endforeach
                                </select> 
                            </td>                       
                            <td width="10%"><input type="text" name="akun_id[]" class="form-control akun_id"></td>
                            <td width="5%">
                            <!--
                            <input type="text" name="qty[]" style="text-align: right;" class="form-control qty">
                            -->
                            {{ Form::text('qty_terima[]', old('kode_produk'), array('class' => 'form-control qty_terima')) }}
                            </td>
                            <td width="5%">
                            <!--<input type="text" name="qty_pesan[]" style="text-align: right;" class="form-control qty_pesan">
                            -->
                            {{ Form::text('qty_pesan[]', old('qty_pesan'), array('class' => 'form-control qty_pesan')) }}</td>
                            <td width="8%"><input type="text" name="uom_id[]" class="form-control uom_id"></td>
                            <td width="10%"><input type="text" name="harga[]" style="text-align: right;" class="form-control harga"></td>
                            <td width="5%"><input type="text" name="discount[]" style="text-align: center;" class="form-control discount"></td>
                            <td width="10%"><input type="text" name="amount[]" style="text-align: right; background: #eee;" class="form-control amount" readonly="true"></td>
                            <td width="6%"><input type="text" name="pajak[]" style="text-align: center;"  class="form-control pajak"></td>
                            <td width="5%"><input  type="text" name="proyek2[]" class="form-control proyek2"></td>
                            <td width="0%" hidden="true" ><input  type="hidden" name="proyek1[]" class="form-control proyek1"></td>
                            <td width="5%" style="text-align:center;"><a href="#" style="text-align: center;" class="btn btn-danger btn-xs remove"><i class="glyphicon glyphicon-minus" ></i></a></td>                            
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                
            </div>
            </div>

                <div class="form-group">
                    <div class="form-group">
                    <div class="col-sm-2">
                    {!! Form::label('tanggal_kirim', 'Tanggal Pengiriman :', ['class' => 'control-label']) !!}
                    <input type="text" class="form-control" name="tanggal_kirim" id="tanggal_kirim" placeholder="Tanggal Pengiriman" value="01/03/2018">                
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <div class="col-sm-2">
                    {!! Form::label('bagian_pembelian', 'Bagian Pembelian :', ['class' => 'control-label']) !!}
                    <input type="text" class="form-control" name="bagian_pembelian" id="bagian_pembelian" placeholder="">
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <div class="col-sm-2">
                    
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-2">
                    
                    </div>
                    </div>
               
                </div>

                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">Biaya-biaya lain :</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <input placeholder="0.0" name="biaya_lain" id="biaya_lain" class="biaya_lain form-control" type="text" style="text-align: right;" >
                       <input type="hidden" id="bl" name="bl" class="form-control bl" hidden="true">
                    </div>
                </div>
                </div>
                

                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>

                <div class="text-right">
                <div class="form-group style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">Total Pajak :</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <input type="text" name="totalpajak" class="form-control totalpajak" style="text-align: right;background: #eee;" readonly="true">
                    </div>
                </div>
                </div>

                <!-- -->
                <div class="text-right">
                <div class="form-group style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>
                
                <div class="text-right">
                <div class="form-group style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>

                <div class="text-right">
                <div class="form-group style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">Total Setelah Pajak :</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <input type="text" name="totalsetelahpajak" class="form-control totalsetelahpajak" style="text-align: right;background: #eee;" readonly="true">
                       <input type="hidden" id="totalsetelahpajak2" name="totalsetelahpajak2" class="form-control totalsetelahpajak2" hidden="true">   
                       <input type="hidden" id="totalsetelahpajak3" name="totalsetelahpajak3" class="form-control totalsetelahpajak3" hidden="true">   
                    </div>
                </div>
                </div>
                <!-- -->

                <div class="form-group">
                    <div class="form-group">
                    <div class="col-sm-2">
                    {!! Form::label('denda_terlambat', 'Term Pembayaran :', ['class' => 'control-label']) !!}
                    <input type="text" class="form-control" name="denda_terlambat" id="denda_terlambat" placeholder="% Net 0">                
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <div class="col-sm-2">
                    {!! Form::label('debit_kredit', 'Nota Debit/Kredit :', ['class' => 'control-label']) !!}
                    <input type="text" class="form-control" name="debit_kredit" id="debit_kredit" placeholder="">
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <div class="col-sm-2">
                    
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-2">
                    
                    </div>
                    </div>               
                </div>


                <div class="text-right">
                <div class="form-group style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>
                
                <div class="text-right">
                <div class="form-group style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>
                
                <div class="text-right">
                <div class="form-group" style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">Uang Muka :</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <input name="uang_muka" id="uang_muka" class=" form-control uang_muka" type="text" style="text-align: right;" placeholder="0.0">
                    </div>
                </div>
                </div>

                <div class="text-right">
                <div class="form-group style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>
                
                <div class="text-right">
                <div class="form-group style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">&nbsp;</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <p><span>&nbsp;</span></p>
                    </div>
                </div>
                </div>
                
                <div class="text-right">
                <div class="form-group style="vertical-align: middle;">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" style="vertical-align: middle;">Saldo Terutang :</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <input type="text" name="saldo_terutang" class="form-control saldo_terutang" style="text-align: right;background: #eee;" readonly="true">
                    </div>
                </div>
                </div>


            </div>


    </div>
    </div>  


        <div class="col-lg-2 col-sm-2">
            <div class="form-group">
                <a href="{{route('pembelian.index')}}" class="btn btn-primary">Batal</a>
                {!!Form::submit('Rekam', array('class'=>'btn btn-primary'))!!}
            </div>  
        </div>  

        <div class="form-group">
            <!--
            <input type="checkbox" name="is_cetak[]" value="Y" class="flat"> <label><b> Cetak</b></label>
            <input type="checkbox" name="is_tunai[]" value="Y" class="flat"> <label><b> Tunai</b></label>
            -->
            
            {!! Form::checkbox('is_cetak', 1, null, ['class' => 'flat']) !!}
            {!! Form::label('is_cetak', ' Cetak', ['class' => 'control-label']) !!}

            
            {!! Form::checkbox('is_tunai', 1, null, ['class' => 'flat']) !!}
            {!! Form::label('is_tunai', ' Tunai', ['class' => 'control-label']) !!}


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
            $("#tanggal_faktur").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
             $("#tanggal_kirim").datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        })
        });
    </script>

    <!--
    <script type="text/javascript">

        var input = document.getElementById('name-input');
            
            input.addEventListener('keyup', function(e)
            {
                input.value = format_number(this.value, '');
            });
            
            input.addEventListener('keydown', function(event)
            {
                limit_character(event);
            });



        function format_number(number, prefix, thousand_separator, decimal_separator)
            {
                var thousand_separator = thousand_separator || ',',
                    decimal_separator = decimal_separator || '.',
                    regex       = new RegExp('[^' + decimal_separator + '\\d]', 'g'),
                    number_string = number.replace(regex, '').toString(),
                    split     = number_string.split(decimal_separator),
                    rest      = split[0].length % 3,
                    result    = split[0].substr(0, rest),
                    thousands = split[0].substr(rest).match(/\d{3}/g);
                
                if (thousands) {
                    separator = rest ? thousand_separator : '';
                    result += separator + thousands.join(thousand_separator);
                }
                result = split[1] != undefined ? result + decimal_separator + split[1] : result;
                return prefix == undefined ? result : (result ? prefix + result : '');
            };

        function limit_character(event)
            {
                key = event.which || event.keyCode;
                if ( key != 188 // Comma
                     && key != 8 // Backspace
                     && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
                     && (key < 48 || key > 57) // Non digit
                     // And many more, such as: del, left arrow dan right arrow, tab, etc...
                    ) 
                {
                    event.preventDefault();
                    return false;
                }
            };   
    </script>   
    -->     

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
                url     : '{!!URL::route('pembelian.findSatuan')!!}',
                dataType: 'json',
                data    : dataId,
                success:function(data){
                    tr.find('.uom_id').val(data.uom_id);
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
            var tr =  '<tr>'+
                            '<td width="8%"><input type="text" name="kode_produk[]" class="form-control kode_produk"></td>'+
                            '<td width="15%">'+
                                '<select class="form-control nama_produk" name="nama_produk[]" id="nama_produk">'+
                                '<option value="0" selected="true" disabled="true">Pilih Produk</option>'+
                                '@foreach($product_list as $key => $p)'+   
                                '<option value="{!!$key!!}">{!!$p!!}</option>'+
                                '@endforeach'+
                                '</select>'+
                            '</td>'+                           
                            '<td width="10%"><input type="text" name="akun_id[]" class="form-control akun_id"></td>'+
                            '<td width="5%"><input type="text" name="qty[]" style="text-align: right;" class="form-control qty"></td>'+
                            '<td width="5%"><input type="text" name="qty_pesan[]" style="text-align: right;" class="form-control qty_pesan"></td>'+
                            '<td width="8%"><input type="text" name="uom_id[]" class="form-control uom_id"></td>'+
                            '<td width="10%"><input type="text" name="harga[]" style="text-align: right;" class="form-control harga"></td>'+
                            '<td width="5%"><input type="text" name="discount[]" style="text-align: center;" class="form-control discount"></td>'+
                            '<td width="10%"><input type="text" name="amount[]" style="text-align: right; background: #eee;" class="form-control amount" readonly="true"></td>'+
                            '<td width="6%"><input type="text" name="pajak[]" style="text-align: center;"  class="form-control pajak"></td>'+
                            '<td width="5%"><input type="text" name="proyek2[]" class="form-control proyek2"></td>'+
                            '<td width="0%" hidden="true" ><input type="hidden" name="proyek1[]" class="form-control proyek1"></td>'+
                            '<td width="5%" style="text-align:center;"><a href="#" class="btn btn-xs btn-danger remove"><i class="glyphicon glyphicon-minus"></i></a></td>'+
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
            //total2();
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

