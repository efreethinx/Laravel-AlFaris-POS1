<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pembayaran_id');
            $table->string('no_reff');
            $table->string('no_faktur');
            $table->integer('saldo');
            $table->integer('diskon');
            $table->integer('jml_dibayar');
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
        Schema::dropIfExists('pembayaran_details');
    }
}
