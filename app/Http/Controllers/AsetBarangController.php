<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsetBarangRequest;
use App\Models\MasterAsetBarang;
use App\Services\AsetBarangService;
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
}
