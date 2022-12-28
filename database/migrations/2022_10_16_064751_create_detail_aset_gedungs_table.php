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
        Schema::create('detail_aset_gedung', function (Blueprint $table) {
            $table->integer("id",true);
            $table->integer("NUP");
            $table->string("Kondisi",16);
            $table->date("Tgl_Rekam_Pertama");
            $table->date("Tgl_Perolehan");
            $table->decimal("Nilai_Perolehan_Pertama",16,2);
            $table->decimal("Nilai_Mutasi",16,2);
            $table->decimal("Nilai_Perolehan",16,2);
            $table->decimal("Nilai_Penyusutan",16,2);
            $table->decimal("Nilai_Buku",16,2);
            $table->decimal("Kuantitas",16,2);
            $table->integer("jml_foto");
            $table->string("Status_Penggunaan",128);
            $table->string("Status_Pengelolaan",128);
            $table->string("No_PSP",128);
            $table->date("Tgl_PSP");
            $table->integer("Jumlah_KIB");
            $table->string("Dokumen",16);
            $table->Decimal("Luas_Bangunan",16,2);
            $table->Decimal("Luas_Dasar_Bangunan",16,2);
            $table->integer("Jumlah_Lantai");
            $table->string("Jalan",128);
            $table->string("Kode_Kab_Kota",24);
            $table->string("Uraian_Kab_Kota",48);
            $table->string("Kode_Pos",8);
            $table->integer("SBSK");
            $table->integer("Optimalisasi");
            $table->string("Status_SBSN",64);
            $table->string("Uraian_Provinsi",128);
            $table->string("Kode_Provinsi",64);
            $table->string("Kode_Gedung",24);
            $table->string("Kode_Satker",24);
            $table->integer("Tahun_Data");
            $table->foreign("Kode_Satker")->references("Kode_Satker")->on("master_satker")
            ->constrained()
            ->onUpdate("cascade")
            ->onDelete("cascade");
            $table->foreign("Kode_Gedung")->references("Kode_Gedung")->on("master_aset_gedung")
            ->constrained()
            ->onUpdate("cascade")
            ->onDelete("cascade");
        })
        ;
    }
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
