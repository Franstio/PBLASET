<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsetBarangRequest;
use App\Http\Requests\DetailAsetBarangRequest;
use App\Http\Requests\LokasiRequest;
use App\Models\DetailAsetBarang;
use App\Models\DetailAsetGedung;
use App\Models\MasterAsetBarang;
use App\Services\AsetBarangService;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AsetBarangController extends Controller
{
    protected AsetBarangService $service;
    function __construct(AsetBarangService $_service)
    {
        $this->service = $_service;
    }
    public function master_index()
    {
        $name=  "Master Aset Barang";
        return view("pblaset.master-form.master_barang",compact("name"));
    }
    public function get_data_master(Request $request)
    {
        return $this->service->GetMasterDataTable($request);
    }
    public function tambah_data_master(AsetBarangRequest $req)
    {
        $this->service->Create($req);
        return redirect()->back();
    }
    public function update_data_master(string $kode_barang,AsetBarangRequest $req)
    {
        $this->service->Update($kode_barang,$req);
        return redirect()->back();
    }
    public function delete_data_master(string $kode_barang)
    {
        $this->service->Delete($kode_barang);
        return response()->json(['message'=>"success"],200);
    }
    public function RetrieveDetailAsetBarang(int $id)
    {
        $data = DetailAsetBarang::where("id",$id);
        if ($data->count() < 1)
            return response()->isNotFound();
        return response()->json($data);
    }
    public function get_data_detail(DetailAsetBarangRequest $req)
    {
        return $this->service->GetDetailDataTable($req);
    }
    public function InsertDetailAset(DetailAsetBarangRequest $req)
    {
        $this->service->InsertDetailAset($req);
        return redirect()->back();
    }
    public function UpdateDetailAset(String $id,DetailAsetBarangRequest $req)
    {
        return $this->service->UpdateDetailAset($id,$req);
        return redirect()->route("aset.barang.detail");
    }
    public function DeleteDetailAset(String $id)
    {
        $this->service->DeleteDetailAset($id);
        return response()->json(['message'=>"success"],200);
    }
    public function GetListBarang(String $nama)
    {
        return $this->service->RetrieveMasterBarang($nama);
    }
    public function GetListBarangAll()
    {
        return $this->GetListBarang("");
    }
    public function GetDetails($id)
    {
        return $this->service->RetrieveDetailAsetBarang($id);
    }
    public function Import(LokasiRequest $req)
    {
        return $this->service->ImportData($req);
    }
    public function Export(LokasiRequest $req,$year)
    {
        return $this->service->ExportData($req,$year);
    }
}
