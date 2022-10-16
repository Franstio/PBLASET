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
        Schema::create('ruangan', function (Blueprint $table) {
            $table->string("Nama_Ruangan",64);
            $table->integer("Kode_Lantai",11);
            $table->string("Kode_Ruangan",16);
            $table->foreign("Kode_Lantai")->references("id")->on("lantai")
            ->constrained()
            ->onUpdate("cascade")
            ->onDelete("cascase");
            $table->primary("Kode_Ruangan");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruangans');
    }
};
