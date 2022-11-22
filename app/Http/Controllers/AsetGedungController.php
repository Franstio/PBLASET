<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsetGedungRequest;
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
}
