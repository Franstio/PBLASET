<?php

namespace App\Services;

use App\Http\Requests\LokasiGedungRequest;
use App\Models\MasterLokasiGedung;
use App\Models\Gedung;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LokasiService
{
    public function __construct()
    {

    }
    public function CreateGedung(LokasiGedungRequest $request)
    {
        $existed = Gedung::where('id',$request->input("id"));
        if ($existed->count() > 0)
            return redirect()->back()->with(["Error"=>"Gedung dengan kode ini sudah ada"]);
        $insert =  Gedung::create($request->all());

        return $insert;
    }
    public function UpdateGedung(String $id,LokasiGedungRequest $request )
    {
        $existed = Gedung::where("id",$id);
        if ($existed->count() < 1)
            return redirect()->back()->withErrors(["Error"=>"Kode Gedung tidak dapat ditemukan"]);
        $updated = $existed->update($request->except("_token"));
    }
    public function DeleteGedung(String $id)
    {
        $existed = Gedung::where("id",$id);
        if ($existed->count() < 1)
            return redirect()->back()->withErrors(["Error"=>"Kode Gedung tidak dapat ditemukan"]);
        $existed->delete();
    }
    public function ReadGedung(Request $request)
    {
        $data = Gedung::get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $json = json_encode($row);
                $id = $row->id;
                $btn = "<span class='table-remove'>
              <button type='button' class='btn btn-info btn-rounded btn-sm my-0'><a href='Detail('$id')'>DETAIL</a>
              </button></span>
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
