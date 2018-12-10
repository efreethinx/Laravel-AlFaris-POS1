<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akuns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_akun')->unique();
            $table->string('nama_akun');
            $table->string('nama_alias')->nulable();
            $table->string('subklasifikasi_id')->nulable();
            $table->string('kas_bank')->nulable();
            $table->string('is_active')->nulable();
            $table->string('kurs')->nulable();
            $table->string('departement_id')->nulable();
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
        Schema::dropIfExists('akuns');
    }
}
