<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
	    	'id','kode_kategori','nama_kategori','departement_id','sifat_persediaan_disimpan','sifat_persediaan_dibeli','sifat_persediaan_dijual','sistem_persediaan_average_costing','akun_harga_pokok','akun_penjualan','akun_persediaan','gambar',
	    ];
}
