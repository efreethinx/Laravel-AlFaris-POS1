<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoToko extends Model
{
    protected $fillable = [
    	'id', 'nama_toko', 'alamat_toko', 'desa_toko', 'kecamatan_toko', 'kota_toko', 'provinsi_toko', 'hp_toko',
    ];

    protected $table = 'info_toko';
}
