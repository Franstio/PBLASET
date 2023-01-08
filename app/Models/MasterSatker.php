<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSatker extends Model
{
    use HasFactory;
    protected $table = "master_satker";
//    protected $primaryKey = 'Kode_Satker';
    public $timestamps = false;
    protected $fillable = [ "Kode_Satker","Nama_Satker" ];
}
