<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
protected $fillable = [
    	'id', 'kode_departement', 'nama_departement', 'sub_departement', 'manager', 'bidang', 'catatan',
    ];
}
