<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = "ruangan";
    protected $primaryKey = 'Kode_Ruangan';
    public $timestamps = false;
    protected $fillable = [ "Kode_Ruangan","Kode_Lantai"."Nama_Ruangan" ];
}
