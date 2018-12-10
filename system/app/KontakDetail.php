<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KontakDetail extends Model
{
    protected $fillable = [
    'id',
    'kontak_id',
    'kode_kontak',
    'alamat1',
	'alamat2',
	'kota1',
	'kode_pos1',
	'negara1',
	'alamat_pengiraman1',
	'alamat_pengiraman2',
	'kota2',
	'kode_pos2',
	'negara2',
	'kontak2',
	'catatan',
	'photo',
	];
}
