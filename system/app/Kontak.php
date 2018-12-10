<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
protected $fillable = [
    	'id', 
    	'kode_kontak',
		'nama_kontak',
		'kurs',
		'tipe',
		'jenis',
		'klasifikasi',
		'kontak',
		'jabatan',
		'phone1',
		'phone2',
		'fax',
		'handphone',
		'email',
		'situs_web',
		'npwp',
		'batas_kredit',
		'hari_diskon',
		'jatuh_tempo',
		'diskon_awal',
		'denda_terlambat',
    ];
}
