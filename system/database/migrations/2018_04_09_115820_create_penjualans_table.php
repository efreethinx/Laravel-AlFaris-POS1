<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kontak_id');
            $table->string('no_faktur');
            $table->string('no_po');
            $table->date('tanggal_faktur');
            $table->string('proyek');
            $table->integer('gudang_keluar_id');
            $table->string('keterangan');
            $table->integer('departement_id');
            $table->date('tanggal_kirim');
            $table->integer('sales');
            $table->integer('term_pembayaran');
            $table->integer('debit_kredit');
            $table->integer('biaya_lain');
            $table->integer('total_pajak');
            $table->integer('total_setelah_pajak');
            $table->integer('uang_muka');
            $table->integer('saldo_terutang');
            $table->string('is_tunai');
            $table->string('is_cetak');
            $table->string('is_void');
            $table->string('is_canceled');
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
        Schema::dropIfExists('penjualans');
    }
}
