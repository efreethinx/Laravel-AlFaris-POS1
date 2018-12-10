<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiutangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piutangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_reff')->unique();
            $table->date('tanggal');
            $table->integer('nilai');
            $table->integer('akun_id');
            $table->integer('kontak_id');
            $table->string('proyek')->nullable();
            $table->integer('departement_id');
            $table->text('keterangan')->nullable();
            $table->integer('denda')->nullable();
            $table->integer('userid');
            $table->string('is_giro')->nullable();
            $table->string('is_cetak')->nullable();
            $table->string('is_batal')->nullable();
            $table->string('is_void')->nullable();
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
        Schema::dropIfExists('piutangs');
    }
}
