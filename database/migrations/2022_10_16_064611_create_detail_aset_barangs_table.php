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
            $table->integer("NUP",11);
            $table->string("Kondisi",16);
            $table->date("Tgl_Rekam_Pertama");
            $table->date("Tgl_Perolehan");
            $table->decimal("Nilai_Perolehan_Pertama",10,2);
            $table->decimal("Nilai_Mutasi",10,2);
            $table->decimal("Nilai_Perolehan",10,2);
            $table->decimal("Nilai_Penyusutan",10,2);
            $table->decimal("Nilai_Buku",10,2);
            $table->decimal("Kuantitas",10,2);
            $table->integer("jml_foto",10,2);
            $table->string("Status_Penggunaan",128);
            $table->string("Status_Pengelolaan",128);
            $table->string("No_PSP",24);
            $table->date("Tgl_PSP");
            $table->integer("Jumlah_KIB",11);
            $table->foreign("Kode_Ruangan")->references("Kode_ruangan")->on("ruangan")
            ->constrained()
            ->onUpdate("cascade")
            ->onDelete("cascase");
            $table->foreign("Kode_Satker")->references("Kode_Satker")->on("master_satker")
            ->constrained()
            ->onUpdate("cascade")
            ->onDelete("cascase");
            $table->foreign("Kode_Barang")->references("Kode_Barang")->on("master_aset_barang")
            ->constrained()
            ->onUpdate("cascade")
            ->onDelete("cascase");
            $table->primary("Id",11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_aset_barangs');
    }
};
