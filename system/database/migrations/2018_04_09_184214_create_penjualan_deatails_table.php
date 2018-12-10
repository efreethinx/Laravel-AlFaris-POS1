<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualanDeatailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_deatails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('penjualan_id');
            $table->string('no_faktur');
            $table->integer('produk_id');
            $table->integer('akun_id');
            $table->integer('qty_terima');
            $table->integer('qty_pesan');
            $table->integer('uom_id');
            $table->float('harga_jual');
            $table->decimal('diskon');
            $table->float('total');
            $table->decimal('pajak');
            $table->string('proyek2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan_deatails');
    }
}
