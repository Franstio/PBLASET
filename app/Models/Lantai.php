<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    use HasFactory;
    protected $table = "lantai";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [ "id","no_Lantai"."Kode_Gedung" ];
}
