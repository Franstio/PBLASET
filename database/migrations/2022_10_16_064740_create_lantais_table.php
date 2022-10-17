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
        Schema::create('lantai', function (Blueprint $table) {
            $table->integer("no_lantai",11);
            $table->integer("id",11);
            $table->integer("Kode_Gedung",11);
            $table->foreign("Kode_Gedung")->references("Kode_Gedung")->on("Gedung")
            ->constrained()
            ->onUpdate("cascade")
            ->onDelete("cascase");
            $table->primary("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lantais');
    }
};
