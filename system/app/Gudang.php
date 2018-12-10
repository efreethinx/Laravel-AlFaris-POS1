<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
protected $fillable = [ 'id',
    	'kode_gudang',
		'nama_gudang',
		'dimensi_container',
		'alamat',
		'kota',
		'kode_pos',
		'negara',
		'keterangan',
		'kategori_gudang',
		'is_container',
		'is_active',
	];
}
