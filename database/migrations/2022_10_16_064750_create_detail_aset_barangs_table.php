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
        Schema::create('detail_aset_barang', function (Blueprint $table) {
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
            $table->string("Kode_Barang",16);
            $table->string("Kode_Ruangan",16);
            $table->string("Kode_Satker",24);
            $table->integer("Tahun_Data");
            $table->foreign("Kode_Ruangan")->references("Kode_ruangan")->on("ruangan")
            ->constrained()
            ->onUpdate("cascade")
            ->onDelete("cascade");
            $table->foreign("Kode_Satker")->references("Kode_Satker")->on("master_satker")
            ->constrained()
            ->onUpdate("cascade")
            ->onDelete("cascade");
            $table->foreign("Kode_Barang")->references("Kode_Barang")->on("master_aset_barang")
            ->constrained()
            ->onUpdate("cascade")
            ->onDelete("cascade");
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
