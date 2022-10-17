<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_aset_barang', function (Blueprint $table) {
            $table->string("Merk_Tipe",128);
            $table->string("Nama_Barang",128);
            $table->string("Kode_Barang",16);
            $table->primary("Kode_Barang");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_aset_barangs');
    }
};
