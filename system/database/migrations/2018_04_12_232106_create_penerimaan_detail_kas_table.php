<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenerimaanDetailKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimaan_detail_kas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('penerimaan_id');
            $table->integer('akun_id');
            $table->integer('departement_id');
            $table->integer('jml_keluar');
            $table->string('job')->nullable();
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
        Schema::dropIfExists('penerimaan_detail_kas');
    }
}
