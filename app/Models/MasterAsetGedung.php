<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAsetGedung extends Model
{
    use HasFactory;
    protected $table = "master_aset_gedung";
    protected $primaryKey = 'Kode_Gedung';
    public $timestamps = false;
    protected $fillable = [ "Kode_Gedung","Nama_Gedung" ];
}