<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_produk')->nullable();
            $table->string('kode_produk')->nullable();
            $table->string('kategori_id')->nullable();
            $table->string('kode_alias')->nullable();
            $table->string('nama_alias')->nullable();
            $table->string('harga_jual_satuan')->nullable();
            $table->string('suppiler_id')->nullable();
            $table->string('uom_id')->nullable();
            $table->string('pajak_masuk')->nullable();
            $table->string('pajak_keluar')->nullable();
            $table->string('is_active')->nullable();
            $table->string('is_jasa')->nullable();
            $table->string('photo_produk')->nullable();
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
        Schema::dropIfExists('products');
    }
}
