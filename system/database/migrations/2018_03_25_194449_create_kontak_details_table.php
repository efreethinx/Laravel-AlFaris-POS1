<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKontakDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontak_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alamat1')->nullabel();
            $table->string('alamat2')->nullabel();
            $table->string('kota1')->nullabel();
            $table->string('kode_pos1')->nullabel();
            $table->string('negara1')->nullabel();
            $table->string('alamat_pengiraman1')->nullabel();
            $table->string('alamat_pengiraman2')->nullabel();
            $table->string('kota2')->nullabel();
            $table->string('kode_pos2')->nullabel();
            $table->string('negara2')->nullabel();
            $table->string('kontak2')->nullabel();
            $table->text('catatan')->nullabel();
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
        Schema::dropIfExists('kontak_details');
    }
}
