<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_kas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_akun_id');
            $table->integer('to_akun_id');
            $table->date('tanggal');
            $table->string('no_reff')->unique();
            $table->integer('departement_id')->nullable();
            $table->integer('nilai')->default(0);
            $table->text('keterangan')->nullable();
            $table->integer('userid');
            $table->boolean('is_cetak')->default(0)->nullable();
            $table->boolean('is_batal')->default(0)->nullable();
            $table->boolean('is_deleted')->default(0)->nullable();
            $table->boolean('is_void')->default(0)->nullable();
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
        Schema::dropIfExists('transfer_kas');
    }
}
