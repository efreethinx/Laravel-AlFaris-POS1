<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_kategori')->unique();
            $table->string('nama_kategori')->unique();
            $table->string('departement_id')->nullable();
            $table->string('sifat_persediaan_disimpan')->nullable();
            $table->string('sifat_persediaan_dibeli')->nullable();
            $table->string('sifat_persediaan_dijual')->nullable();
            $table->string('sistem_persediaan_average_costing')->nullable();
            $table->string('akun_harga_pokok')->nullable();
            $table->string('akun_penjualan')->nullable();
            $table->string('akun_persedian')->nullable();
            $table->string('gambar')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
