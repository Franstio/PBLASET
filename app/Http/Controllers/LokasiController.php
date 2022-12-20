<?php

namespace App\Http\Controllers;

use App\Models\Lantai;
use App\Http\Requests\LokasiGedungRequest;
use App\Http\Requests\LokasiLantaiRequest;
use App\Http\Requests\LokasiRuanganRequest;
use App\Services\LokasiService;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    private LokasiService $service;
    public function __construct(LokasiService $_service)
    {
        $this->service = $_service;
    }
    public function index()
    {
        return view("pblaset.lokasi.list-gedung");
    }
    public function CreateGedung(LokasiGedungRequest $req)
    {
        $this->service->CreateGedung($req);
        return redirect()->back();
    }
    public function UpdateGedung(LokasiGedungRequest $req,string $kode_gedung)
    {
        $this->service->UpdateGedung($kode_gedung,$req);
        return redirect()->back();
    }
    public function ReadGedung(Request $req)
    {
        $res = $this->service->ReadGedung($req);
        return $res;
    }
    public function DeleteGedung(string $Kode_Gedung)
    {
        $this->service->DeleteGedung($Kode_Gedung);
        return response()->json("ok");
    }

    public function index_lantai($kode_gedung,$nama_gedung)
    {
        $data = ["kode_gedung"=>$kode_gedung,"nama_gedung"=>$nama_gedung];
        return view("pblaset.lokasi.list-Lantai",compact("data"));
    }
    public function CreateLantai(LokasiLantaiRequest $req,string $nama_gedung,string $kode_gedung)
    {
        $this->service->CreateLantai($req,$kode_gedung);
        return redirect()->back();
    }
    public function ReadLantai(LokasiLantaiRequest $req)
    {
        $res = $this->service->ReadLantai($req);
        return $res;
    }
    public function UpdateLantai(LokasiLantaiRequest $req,$nm,$kg,$id)
    {
        $m = Lantai::where("id",$id)->first();
        $this->service->UpdateLantai($m->no_lantai,$m->Kode_Gedung,$req);
        return redirect()->back();
    }
    public function DeleteLantai(string $nm,string $kd,string $id)
    {
        $m = Lantai::where("id",$id)->first();
        $this->service->DeleteLantai($m->Kode_Gedung,$m->no_lantai);
        return response()->json("ok");
    }
    public function index_ruangan($kode_gedung,$nama_gedung,$no_lantai,$kode_lantai)
    {
        $data = ["kode_gedung"=>$kode_gedung,"nama_gedung"=>$nama_gedung,"no_lantai"=>$no_lantai,"kode_lantai"=>$kode_lantai];
        return view("pblaset.lokasi.list-ruangan",compact("data"));
    }
    public function CreateRuangan(LokasiRuanganRequest $req,$kode_gedung,$nama_gedung,$no_lantai,$kode_lantai)
    {
        $this->service->CreateRuangan($req,$kode_lantai);
        return redirect()->back();
    }

    public function ReadRuangan(LokasiRuanganRequest $req)
    {
        $res = $this->service->ReadRuangan($req);
        return $res;
    }
    public function UpdateRuangan(LokasiRuanganRequest $req,$kode_gedung,$nama_gedung,$no_lantai,$kode_lantai,$kode_ruangan)
    {
        $this->service->UpdateRuangan($kode_ruangan,$kode_lantai,$req);
        return redirect()->back();
    }

    public function DeleteRuangan($kode_gedung,$nama_gedung,$no_lantai,$kode_lantai,$kode_ruangan)
    {
        $this->service->DeleteRuangan($kode_ruangan,$kode_lantai);
        return redirect()->back();
    }
    public function ListRuangan(string $lokasi="")
    {
        return $this->service->RetrieveLokasiSuggestion($lokasi);
    }


}
