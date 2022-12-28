<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsetGedungRequest;
use App\Http\Requests\DetailAsetGedungRequest;
use App\Http\Requests\LokasiRequest;
use App\Models\DetailAsetGedung;
use App\Services\AsetGedungService;
use Illuminate\Http\Request;

class AsetGedungController extends Controller
{
    protected AsetGedungService $service;
    function __construct(AsetGedungService $_service)
    {
        $this->service = $_service;
    }
    public function master_index()
    {
        $name = "Master Aset Gedung";
        return view("pblaset.master-form.master_Gedung",compact('name'));
    }
    public function get_data_master(Request $request)
    {
        return $this->service->GetMasterDataTable($request);
    }
    public function tambah_data_master(AsetGedungRequest $req)
    {
        $this->service->Create($req);
        return redirect()->back();
    }
    public function update_data_master(string $kode_Gedung,AsetGedungRequest $req)
    {
        $this->service->Update($kode_Gedung,$req);
        return redirect()->back();
    }
    public function delete_data_master(string $kode_Gedung)
    {
        $this->service->Delete($kode_Gedung);
        return response()->json(['message'=>"success"],200);
    }
    public function RetrieveDetailAsetGedung(int $id)
    {
        $data = DetailAsetGedung::where("id",$id);
        if ($data->count() < 1)
            return response()->isNotFound();
        return response()->json($data);
    }
    public function get_data_detail(DetailAsetGedungRequest $req)
    {
        return $this->service->GetDetailDataTable($req);
    }
    public function InsertDetailAset(DetailAsetGedungRequest $req)
    {
        $this->service->InsertDetailAset($req);
        return redirect()->back();
    }
    public function UpdateDetailAset(String $id,DetailAsetGedungRequest $req)
    {
        return $this->service->UpdateDetailAset($id,$req);
        return redirect()->route("aset.barang.detail");
    }
    public function DeleteDetailAset(String $id)
    {
        $this->service->DeleteDetailAset($id);
        return response()->json(['message'=>"success"],200);
    }
    public function GetListGedung(String $nama)
    {
        return $this->service->RetrieveMasterGedung($nama);
    }
    public function GetListGedungAll()
    {
        return $this->GetListGedung("");
    }
    public function GetDetails($id)
    {
        return $this->service->RetrieveDetailAsetGedung($id);
    }
    public function Import(LokasiRequest $req)
    {
        return $this->service->ImportData($req);
    }
    public function Export($year)
    {
        return $this->service->ExportData($year);
    }
}
