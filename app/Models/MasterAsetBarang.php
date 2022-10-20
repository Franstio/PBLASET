<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAsetBarang extends Model
{
    use HasFactory;
    protected $table = "master_aset_barang";
    protected $primaryKey = 'Kode_Barang';
    public $timestamps = false;
    protected $fillable = [ "Kode_Barang","Merk_Tipe"."Nama_Barang" ];
}