<!DOCTYPE html>
<html>
<head>
	<title>Label Pengiriman</title>
	<script type="text/javascript" src="{{asset('/js/ibzhraviuwovypvw.js')}}" defer></script><style type="text/css">#d__fFH{position:absolute;top:-5000px;left:-5000px}#d__fF{font-family:serif;font-size:200px;visibility:hidden}#vatvzdbaewuxazfbwawdyxtuvxcre{display:none!important}
	</style>
</head>
<body>

	<div class="row">
	    <div style="text-align: left;">
	    <br>
		<a style="color: #42B549; font-size: 14px; text-decoration: none;" href="javascript:window.print()">
           <span style="vertical-align: middle">Cetak</span>
           <img src="{{asset('/images/logo/print.png')}}" alt="Print" style="vertical-align: middle;">
        </a> &nbsp;
        <a href="{{route('penjualan.index')}}" class="btn btn-warning">Selesai</a>
		</div>
	    <br>

		<table border="1" width="600px">
		   <thead>
		    <tr>
		    <th>
		        <!-- 
		        <table width="100%" cellspacing="0" cellpadding="0" style="width: 100%; padding-bottom: 20px;">
                    <tbody>
                        <tr style="margin-top: 8px; margin-bottom: 8px;">
                            <td>
                                <img src="https://ecs7.tokopedia.net/img/new_logo.png" alt="Tokopedia">
                            </td>
                            <td style="text-align: right; padding-right: 15px;">
                                <a style="color: #42B549; font-size: 14px; text-decoration: none;" href="javascript:window.print()">
                                    <span style="vertical-align: middle">Cetak</span>
                                    <img src="https://ecs7.tokopedia.net/img/print.png" alt="Print" style="vertical-align: middle;">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                -->
			<table>
					<tr>
						<td colspan="2" style="text-align: left;"><h3>&nbsp;&nbsp;&nbsp;Marwah Fashion</h3></td>
						<td colspan="2" style="text-align: right;"><h3>Label Pengiriman&nbsp;&nbsp;&nbsp;</h3></td>
					</tr>
					<tr><td colspan="4"><hr></td></tr>
					<tr>
						<td style="vertical-align: top; text-align: left;">&nbsp;&nbsp;&nbsp;Expedisi</td>
						<td style="vertical-align: top; text-align: left;">{{ $kirim->expedisi }}</td>
						<td colspan="2" style="vertical-align: top; text-align: left;">Nomor Faktur :</br>{{ $kirim->no_faktur }}</td>
					</tr>
					<tr><td colspan="4">&nbsp;</td></tr>
					<tr>
						<td width="25%" style="vertical-align: top;text-align: left;">&nbsp;&nbsp;&nbsp;Kepada</td>
						<td colspan="4" width="75%" style="text-align: left;"><b>{{ $kirim->nama_konsumen }}</b> - {{ $kirim->hp_konsumen }}<br>{{ $kirim->alamat_konsumen }}, {{ $kirim->desa_konsumen }}, {{ $kirim->kota_konsumen }}, {{ $kirim->provinsi_konsumen }}
						</td>
					</tr><tr><td colspan="4">&nbsp;</td></tr>
					<tr>
						<td width="25%" style="vertical-align: top;text-align: left;">&nbsp;&nbsp;&nbsp;Pengirim</td>
						<td colspan="4" width="75%" style="text-align: left;"><b>{{ $info->nama_toko }}</b> - {{ $info->hp_toko }}<br>{{ $info->alamat_toko }}, Desa. {{ $info->desa_toko }}, Kec. {{ $info->kecamatan_toko }}, {{ $info->kota_toko }}, {{ $info->provinsi_toko }} {{ $info->kode_pos_toko }}
						</td>
					</tr>
					</tr><tr><td colspan="4">&nbsp;</td></tr>
					</tr><tr><td colspan="4">&nbsp;</td></tr>
			</table>
			</th>
			</tr>
		   </thead>	
		</table>
	</div>
	
</body>
<script src="http://www.position-absolute.com/creation/print/jquery.printPage.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
            $('.btnPrint').printPage();
        })
</script>
</html>