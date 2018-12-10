<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengeluaranKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_kas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('akun_id');
            $table->integer('kontak_id');
            $table->string('no_cek')->unique();
            $table->date('tanggal');
            $table->integer('nilai');
            $table->string('proyek')->nullable();
            $table->integer('departement_id');
            $table->string('keterangan')->nullable();
            $table->integer('userid')->nullable();
            $table->boolean('is_giro')->nullable();
            $table->boolean('is_cetak')->nullable();
            $table->boolean('is_void')->nullable();
            $table->boolean('is_batal')->nullable();
            $table->boolean('is_delete')->nullable();
            $table->boolean('is_discharge')->nullable();
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
        Schema::dropIfExists('pengeluaran_kas');
    }
}
