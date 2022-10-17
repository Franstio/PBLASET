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
        Schema::create('master_aset_gedung', function (Blueprint $table) {
            $table->string("Nama_Gedung",24);
            $table->string("Kode_Gedung",24);
            $table->primary("Kode_Gedung");
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_aset_gedungs');
    }
};
