<?php

namespace App\Services;

use App\Http\Requests\SatkerRequest;
use App\Models\MasterSatker;
use DB;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SatkerService
{
    public function __construct()
    {

    }
    public function Create(SatkerRequest $request)
    {
        $existed = MasterSatker::where('Kode_Satker',$request->input("Kode_Barang"));
        if ($existed->count() > 0)
            return redirect()->back()->with(["Error"=>"Satker dengan kode ini sudah ada"]);
        $insert =  MasterSatker::create($request->all());

        return $insert;
    }
    public function Update(String $id,SatkerRequest $request )
    {
        $existed = MasterSatker::where("Kode_Satker",$id);
        if ($existed->count() < 1)
            return redirect()->back()->withErrors(["Error"=>"Kode Satker tidak dapat ditemukan"]);
        $updated = $existed->update($request->except("_token"));
    }
    public function Delete(String $id)
    {
        $existed = MasterSatker::where("Kode_Satker",$id);
        if ($existed->count() < 1)
            return redirect()->back()->withErrors(["Error"=>"Kode Satker tidak dapat ditemukan"]);
        $existed->delete();
    }
    public function GetMasterDataTable(Request $request)
    {
        $data = MasterSatker::get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $json = json_encode($row);
                $id = $row->Kode_Satker;
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
    public function RetrieveSatker(string $nama)
    {
        $query = "Select Nama_Satker,Kode_Satker From Master_Satker Where Nama_Satker like :nama";
        $res = DB::select($query,[":nama"=>"%".$nama."%"]);
        return response()->json($res);
    }
}
