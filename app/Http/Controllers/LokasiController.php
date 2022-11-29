<?php

namespace App\Http\Controllers;

use App\Http\Requests\LokasiGedungRequest;
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
        return view("pblaset.list-gedung");
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

}
