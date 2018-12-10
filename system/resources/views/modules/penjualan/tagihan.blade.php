<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	    .warna-text {
	       color: #FFFFFF;
	    }
	</style>
</head>
<body>
<div style="text-align: left;">
	<a style="color: #42B549; font-size: 14px; text-decoration: none;" href="javascript:window.print()">
        <span style="vertical-align: middle">Cetak</span>
        <img src="{{asset('/images/logo/print.png')}}" alt="Print" style="vertical-align: middle;">
    </a> &nbsp; &nbsp;
    <a href="{{route('penjualan.index')}}" class="btn btn-warning">Selesai</a>
</div>
<table width="790" cellspacing="0" cellpadding="0" class="container" style="width: 790px; padding: 5px;">
	<tr>
		<th>
		<table width="100%" cellspacing="0" cellpadding="0" style="width: 100%; padding-bottom: 20px;">
            <tbody>
                <tr>
                    <td>
                       &nbsp;
                       <!-- <img src="https://ecs7.tokopedia.net/img/new_logo.png" alt="Tokopedia"> 
                    </td>
                    <td style="text-align: left; padding-right: 15px;">
                       <a style="color: #42B549; font-size: 14px; text-decoration: none;" href="javascript:window.print()">
                          <span style="vertical-align: middle">Cetak</span>
                          <img src="https://ecs7.tokopedia.net/img/print.png" alt="Print" style="vertical-align: middle;">
                        </a> -->
                    </td>
        
	    <br>
                </tr>
            </tbody>
        </table>

			<table  width="790">
				<tr>
					<th colspan="5" style="text-align: left; font-style: bold; font-size: 24px"><b>Faktur Penjualan</b></th>
					<th style="text-align: left;">No Faktur</th>
					<th>:</th>
					<th style="text-align: left;">{{ $penjualan->no_faktur }}</th>
				</tr>
				<tr>
					<th colspan="5">&nbsp;</th>
					<th style="text-align: left;">Tgl Faktur </th>
					<th>:</th>
					<?php
						$retrieved = $penjualan->tanggal_faktur;
						$date = DateTime::createFromFormat('Y-m-d', $retrieved);
						$tgl = $date->format('d-m-Y');
					?>
					<th style="text-align: left;">{{ $tgl }}</th>
				</tr>
				<tr>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th style="text-align: left;">Tanggal Kirim </th>
					<th>:</th>
					<?php
						$retrieved = $penjualan->tanggal_kirim;
						$date = DateTime::createFromFormat('Y-m-d', $retrieved);
						$tgl_kirim = $date->format('d-m-Y');
					?>
					<th style="text-align: left;">{{ $tgl_kirim }}</th>
				</tr>
			</table>
			<hr>
			<table>
				<tr>
					<td>
						<table width="100%">
						<thead><tr><th style="text-align: left;">Informasi Kami :</th></tr></thead>
							<tbody>
								<tr>
									<td style="text-align: left; font-size: 20px">{{ $info->nama_toko }}</td>
								</tr>
								<tr>
									<td style="text-align: left; font-size: 16px">{{ $info->alamat_toko }}</td>
								</tr>
								<tr>
									<td style="text-align: left; font-size: 16px">Kota : {{ $info->kota_toko }}</td>
								</tr>
								<tr>
									<td style="text-align: left;">Telepon: {{ $info->hp_toko }}</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td>
						<table  width="100%" style="padding-left: 120px">

						<thead><tr><th style="text-align: left;">Kepada Pelanggan :</th></tr></thead>
						    <tbody>
								<tr>
									<td style="text-align: left;">{{ $penjualan->nama_kontak }}</td>
								</tr>
								<tr>
									<td style="text-align: left;">Alamat : </td>
								</tr>
								<tr>
									<td style="text-align: left;">Phone : {{$penjualan->kontak}}</td>
								</tr><tr>
									<td style="text-align: left;">Website : -</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</table>
			<hr>

			<p style="text-align: left;">Detail Barang :</p>
			<table  width="800" style="font-size: 15px;border-style: solid;" border="1">
				<tr style="font-size: 15px; background-color: rgba(0,0,0,0.1);height: 40px">
					<th style="text-align: left;padding-left: 5px">Kode</th>
					<th style="text-align: left;padding-left: 5px">Deskripsi</th>
					<th>Qty</th>
					<th style="text-align: center;">Harga</th>
					<th style="text-align: center;">Subtotal</th>
					<th>Diskon</th>
					<th style="text-align: center;">Total</th>
				</tr>
				@foreach($items as $item)
                    <tr>
	                    <td style="text-align: left; padding-left: 5px"><b>{{ $item->kode_produk }}</b></td>
	                    <td style="text-align: left; padding-left: 5px"><b>{{ $item->nama_produk }}</b><br/>{{ $item->uom_id }}</td>
	                    <td class="text-center">{{ $item->qty_terima }}</td>
	                    <td class="text-right">{{ number_format($item->harga_jual,2) }}</td>
	                    <td class="text-right">{{ number_format(($item->qty_terima*$item->harga_jual),2) }}</td>
	                    <td class="text-center">{{ $item->diskon }} %</td>	
	                    <td class="text-right">{{ number_format((($item->qty_terima*$item->harga_jual)-(($item->qty_terima*$item->harga_jual)*($item->diskon/100))),2) }}</td>
                    </tr>
                @endforeach
			</table>
			<hr>
			<br>
			<table style="padding-left: 550px">
				<tr>
					<td  style="text-align: right;">Subtotal : </td>
					<td  width="120" style="text-align: right;"">
					<span id="grandTotal">{{ number_format($nett->nett,2) }}</span>
					</td>
				</tr>
				<tr>
					<td  style="text-align: right;">Pajak : </td>
					<td  style="text-align: right;">{{ number_format(0,2) }}</td>
				</tr>
				<tr>
					<td  style="text-align: right;">Total : </td>
					<td  style="text-align: right;">
					<span id="grandTotal">{{ number_format($nett->nett,2) }}</span>
					</td>
				</tr>
				<tr>
					<td  style="text-align: right;">Bayar : </td>
					<td  style="text-align: right;">
					<span id="grandTotal">{{ number_format($penjualan->uang_muka,2) }}</span> 
					</td>
				</tr>
				<hr>
				<br>
				<tr>
					<td  style="text-align: right;">Sisa Bayar : </td>
					<td  style="text-align: right;">
					<span id="grandTotal">{{ number_format(($nett->nett-$penjualan->uang_muka),2) }}</span> 
					</td>
				</tr>
			</table>
		</th>
	</tr>
</table>


</body>
</html>