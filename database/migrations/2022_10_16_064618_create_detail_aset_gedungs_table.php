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
            $table->integer("NUP",11);
            $table->string("Kondisi",16);
            $table->string("Jenis",64);
            $table->date("Tgl_Rekam_Pertama");
            $table->date("Tgl_Perolehan");
            $table->decimal("Nilai_Perolehan_Pertama",10,2);
            $table->decimal("Nilai_Mutasi",10,2);
            $table->decimal("Nilai_Perolehan",10,2);
            $table->decimal("Nilai_Penyusutan",10,2);
            $table->decimal("Nilai_Buku",10,2);
            $table->decimal("Kuantitas",8,2);
            $table->integer("jml_foto",11);
            $table->string("Status_Penggunaan",128);
            $table->string("Status_Pengelolaan",128);
            $table->string("No_PSP",24);
            $table->date("Tgl_PSP");
            $table->integer("Jumlah_KIB",11);
            $table->string("Dokumen",16);
            $table->Decimal("Luas_Bangunan",10,2);
            $table->Decimal("Luas_Dasar_Bangunan",10,2);
            $table->Integer("Jumlah_Lantai",11);
            $table->string("Jalan",128);
            $table->string("Kode_Kab_Kota",24);
            $table->string("Uraian_Kab_Kota",48);
            $table->string("Kode_Pos",8);
            $table->integer("SBSK",11);
            $table->integer("Optimalisasi",11);
            $table->string("Status_SBSK",64);
            $table->string("Kode_Gedung",24);
            $table->string("Kode_Satker",24);
            $table->integer("id",11);
            $table->foreign("Kode_Satker")->references("Kode_Satker")->on("master_satker")
            ->constrained()
            ->onUpdate("cascade")
            ->onDelete("cascase");
            $table->foreign("Kode_Gedung")->references("Kode_Gedung")->on("master_aset_gedung")
            ->constrained()
            ->onUpdate("cascade")
            ->onDelete("cascase");
            $table->primary("Id",11);
        })
        ;
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_aset_gedungs');
    }
};
