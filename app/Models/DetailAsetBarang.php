<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAsetBarang extends Model
{
    use HasFactory;
    protected $table = "detail_aset_barang";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [ "Kode_Barang","NUP","Kondisi","Tgl_Rekam_Pertama","Tgl_Perolehan","Nilai_Perolehan_Pertama","Nilai_Mutasi","Nilai_Perolehan","Nilai_Penyusutan","Nilai_Buku","Kuantitas","Jml_Foto","Status_Penggunaan","Status_Pengelolaan","No_PSP","Tgl_PSP","Jumlah_KIB","Kode_Ruangan","Kode_Satker","Tahun_Data" ];
}
