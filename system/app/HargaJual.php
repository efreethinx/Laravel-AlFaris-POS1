<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HargaJual extends Model
{
		protected $fillable = [
			      'id', 'kontak_id', 'kode_kontak', 'date_add', 'produk', 'harga_jual',
			];
}
