<?php

namespace App\Services;

use App\Http\Requests\AsetGedungRequest;
use App\Models\MasterAsetGedung;
use App\Models\MasterSatker;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AsetGedungService
{
    public function __construct()
    {

    }
    public function Create(AsetGedungRequest $request)
    {
        $existed = MasterAsetGedung::where('Kode_Gedung',$request->input("Kode_Gedung"));
        if ($existed->count() > 0)
            return redirect()->back()->with(["Error"=>"Gedung dengan kode ini sudah ada"]);
        $insert =  MasterAsetGedung::create($request->all());

        return $insert;
    }
    public function Update(String $id,AsetGedungRequest $request )
    {
        $existed = MasterAsetGedung::where("Kode_Gedung",$id);
        if ($existed->count() < 1)
            return redirect()->back()->withErrors(["Error"=>"Kode Gedung tidak dapat ditemukan"]);
        $updated = $existed->update($request->except("_token"));
    }
    public function Delete(String $id)
    {
        $existed = MasterAsetGedung::where("Kode_Gedung",$id);
        if ($existed->count() < 1)
            return redirect()->back()->withErrors(["Error"=>"Kode Gedung tidak dapat ditemukan"]);
        $existed->delete();
    }
    public function GetMasterDataTable(Request $request)
    {
        $data = MasterAsetGedung::get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $json = json_encode($row);
                $id = $row->Kode_Gedung;
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
