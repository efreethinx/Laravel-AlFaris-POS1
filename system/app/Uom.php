<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    protected $fillable = [
    	'id', 'name', 'kode_uom', 'nama_uom', 'deskripsi',
    ];

    protected $table = 'uoms';
    //protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
