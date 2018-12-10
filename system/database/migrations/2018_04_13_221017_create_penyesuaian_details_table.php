<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenyesuaianDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyesuaian_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('penyesuaian_id');
            $table->integer('no_reff');
            $table->integer('produk_id');
            $table->integer('qty_kirim');
            $table->string('uom_id');
            $table->integer('harga_satuan');
            $table->integer('kode_akun');
            $table->string('job');
            $table->string('departement_id');
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
        Schema::dropIfExists('penyesuaian_details');
    }
}
