<?php

namespace App\Services;

use App\Http\Requests\AsetBarangRequest;
use App\Models\MasterAsetBarang;
use App\Models\MasterSatker;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AsetBarangService
{
    public function __construct()
    {

    }
    public function Create(AsetBarangRequest $request)
    {
        $existed = MasterAsetBarang::where('Kode_Barang',$request->input("Kode_Barang"));
        if ($existed->count() > 0)
            return redirect()->back()->with(["Error"=>"Barang dengan kode ini sudah ada"]);
        $insert =  MasterAsetBarang::create($request->all());

        return $insert;
    }
    public function CreateManual(String $kode,String $nama,String $merk)
    {
        $existed = MasterAsetBarang::where('Kode_Barang',$kode);
        if ($existed->count() > 0)
            return redirect()->back()->withErrors(["Error"=>"Barang dengan kode ini sudah ada"]);
        MasterAsetBarang::create(["Kode_Barang"=>$kode,"Nama_Barang"=>$nama,"Merk_Tipe"=>$merk]);
    }
    public function Update(String $id,AsetBarangRequest $request )
    {
        $existed = MasterAsetBarang::where("Kode_Barang",$id);
        if ($existed->count() < 1)
            return redirect()->back()->withErrors(["Error"=>"Kode Barang tidak dapat ditemukan"]);
        $updated = $existed->update($request->except("_token"));
    }
    public function Delete(String $id)
    {
        $existed = MasterAsetBarang::where("Kode_Barang",$id);
        if ($existed->count() < 1)
            return redirect()->back()->withErrors(["Error"=>"Kode Barang tidak dapat ditemukan"]);
        $existed->delete();
    }
    public function GetMasterDataTable(Request $request)
    {
        $data = MasterAsetBarang::get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $json = json_encode($row);
                $id = $row->Kode_Barang;
                $btn = "
                <span class='table-remove'><button onclick=\"Delete('$id')\"  type='button' class='btn btn-danger btn-rounded btn-sm my-0'>
                        Delete
                    </button></span>
                <span class='table-remove'><button onclick='Edit($json)' type='button' class='btn btn-success btn-sm my-0' >
                        Edit
                    </button>
                </span>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }

}
