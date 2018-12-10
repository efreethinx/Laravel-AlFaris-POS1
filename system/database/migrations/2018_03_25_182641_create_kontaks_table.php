<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKontaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontaks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_kontak')->unique();
            $table->string('nama_kontak');
            $table->string('kurs')->nullable();
            $table->string('tipe')->nullable();
            $table->string('jenis')->nullable();
            $table->string('klasifikasi')->nullable();
            $table->string('kontak')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('fax')->nullable();
            $table->string('handphone')->nullable();
            $table->string('email')->nullable();
            $table->string('situs_web')->nullable();
            $table->string('npwp')->nullable();
            $table->string('batas_kredit')->nullable();
            $table->integer('hari_diskon')->nullable();
            $table->integer('hari_jatuh_tempo')->nullable();
            $table->integer('diskon_awal')->nullable();
            $table->integer('denda_terlambat')->nullable();
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
        Schema::dropIfExists('kontaks');
    }
}
