<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAsetGedung extends Model
{
    use HasFactory;
    protected $table = "detail_aset_gedung";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [ "id","Kode_Gedung","Jenis","Kondisi","Tgl_Rekam_Pertama","Tgl_Perolehan","Nilai_Perolehan_Pertama","Nilai_Mutasi","Nilai_Perolehan","Nilai_Penyusutan","Nilai_Buku","Kuantitas","Jml_Foto","Status_Penggunaan","Status_Pengelolaan","No_PSP","Tanggal_PSP","Jumlah_KIB","Dokumen","Luas_Bangunan","Luas_Dasar_Bangunan","Jumlah_lantai","Jalan","Kode_Kab_Kota","Uraian_Kab_Kota","Kode_Provinsi","Uraian_Provinsi","Kode_Pos","SBSK","Optimalisasi","Status_SBSK","Kode_Satker" ];

}