<?php

namespace App\Services;

use App\Http\Requests\LokasiGedungRequest;
use App\Http\Requests\LokasiLantaiRequest;
use App\Http\Requests\LokasiRequest;
use App\Http\Requests\LokasiRuanganRequest;
use App\Models\MasterLokasiGedung;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Ruangan;
use DB;
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
                $nama_gedung = $row->Nama_Gedung;
                $btn = "<span class='table-remove'>
              <button onclick=\"Detail('$id','$nama_gedung')\" type='button' class='btn btn-info btn-rounded btn-sm my-0'>DETAIL
              </button></span>
                <span class='table-remove'><button onclick=\"Delete('$id','$nama_gedung')\"  type='button' class='btn btn-danger btn-rounded btn-sm my-0'>
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

    public function CreateLantai(LokasiLantaiRequest $req,$kode_gedung)
    {
        $existed = Lantai::where([
            ["no_lantai",$req->input("no_lantai")],
            ["kode_gedung",$kode_gedung]
        ])->first();
        if ($existed != null)
            return redirect()->back()->with(["Error"=>"Lantai dengan kode ini sudah ada"]);
        $data  = $req->all();
        $data["Kode_Gedung"] = $kode_gedung;
        $insert =  Lantai::create($data);
        return $insert;
    }
    public function UpdateLantai(String $no_lantai,String $kode_gedung,LokasiLantaiRequest $request )
    {
        $existed = Lantai::where([
            ["no_lantai",$no_lantai],
            ["kode_gedung",$kode_gedung]
        ])->first();
        if ($existed == null)
            return redirect()->back()->withErrors(["Error"=>"Kode Lantai tidak dapat ditemukan"]);
        $updated = $existed->update($request->except("_token"));
    }
    public function DeleteLantai(String $kode_gedung,String $no_lantai)
    {
        $existed = Lantai::where([
            ["no_lantai",$no_lantai],
            ["kode_gedung",$kode_gedung]
        ]);
        if ($existed == null)
            return redirect()->back()->withErrors(["Error"=>"Kode Lantai tidak dapat ditemukan"]);
        $existed->delete();
        return response()->json(["Message"=>"Ok"]);
    }
    public function ReadLantai(Request $request)
    {
        $data = Lantai::where("Kode_Gedung",$request->get("Kode_Gedung"))->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $json = json_encode($row);
                $id = $row->id;
                $nm = $row->no_lantai;
                $btn ="<span class='table-remove'>
              <button type='button' class='btn btn-info btn-rounded btn-sm my-0' onclick=\"Detail('$id','$nm')\">DETAIL</button></span>
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

    public function CreateRuangan(LokasiRuanganRequest $req,$Kode_Lantai)
    {
        $existed = Ruangan::where([
            ["Kode_Lantai",$Kode_Lantai],
            ["kode_Ruangan",$req->input("Kode_Ruangan")]
        ])->first();
        if ($existed != null)
            return redirect()->back()->with(["Error"=>"Ruangan dengan kode ini sudah ada"]);
        $data  = $req->all();
        $data["Kode_Lantai"] = $Kode_Lantai;
        $insert =  Ruangan::create($data);
        return $insert;
    }
    public function UpdateRuangan(String $Kode_Ruangan,String $Kode_Lantai,LokasiRuanganRequest $request )
    {
        $existed = Ruangan::where([
            ["Kode_Ruangan",$Kode_Ruangan],
            ["Kode_Lantai",$Kode_Lantai]
        ])->first();
        if ($existed == null)
            return redirect()->back()->withErrors(["Error"=>"Kode Ruangan tidak dapat ditemukan"]);
        $updated = $existed->update($request->except("_token"));
    }
    public function DeleteRuangan(String $Kode_Ruangan,String $Kode_Lantai)
    {
        $existed = Ruangan::where([
            ["Kode_Ruangan",$Kode_Ruangan],
            ["Kode_Lantai",$Kode_Lantai]
        ])->first();
        if ($existed == null)
            return redirect()->back()->withErrors(["Error"=>"Kode Ruangan tidak dapat ditemukan"]);
        $existed->delete();
    }
    public function ReadRuangan(LokasiRuanganRequest $request)
    {
        $data = Ruangan::where("Kode_Lantai",$request->get("Kode_Lantai"))->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $json = json_encode($row);
                $id = $row->getKey();
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

    public function RetrieveLokasiSuggestion(String $lokasi)
    {
        $query = "Select Lokasi,Kode_Ruangan From (select Concat(Nama_Gedung,', Lantai-',no_lantai,', ',Nama_Ruangan,' ( ',KOde_Ruangan,' ) ') as Lokasi,Kode_Ruangan From Ruangan inner join Lantai on RUangan.Kode_Lantai=Lantai.id inner join Gedung on Gedung.id=Lantai.KOde_Gedung) tbl Where Lokasi like :lokasi ;";
        $res = DB::select($query,[":lokasi"=>'%'.$lokasi.'%'] );
        return response()->json($res);
    }
    public function RetrieveLocation(LokasiRequest $req)
    {
        $query = "Select g.id as 'Kode_Gedung',g.Nama_Gedung,l.id,l.No_Lantai,r.Kode_Ruangan,r.Nama_Ruangan From Gedung g left join lantai l on g.id=l.kode_gedung left join ruangan r on l.id=r.kode_lantai ".
        " Where (g.id = :kode_gedung or :kode_gedung2 ='') and (l.id= :id_lantai or :id_lantai2 ='') and (r.Kode_Ruangan= :kode_ruangan or :kode_ruangan2 ='') ";
        $res = DB::select($query,[":kode_gedung"=>$req->kode_gedung ?? "",":id_lantai"=>$req->id_lantai ?? "",":kode_ruangan"=>$req->kode_ruangan ?? "" ,":kode_gedung2"=>$req->kode_gedung ?? "",":id_lantai2"=>$req->id_lantai ?? "",":kode_ruangan2"=>$req->kode_ruangan ?? ""]);
        return $res;
   }
   public function RetrieveLocation2(Request $req)
   {
        $listGedung = Gedung::get();
        $listLantai = DB::select("Select id,No_Lantai,Kode_Gedung From Lantai where Kode_Gedung=:kode_gedung or :kode_gedung2=''",[":kode_gedung"=>$req->kode_gedung ?? "",":kode_gedung2"=>$req->kode_gedung ?? ""]);
        $listRuangan = DB::select("Select Kode_Ruangan,Nama_Ruangan,Kode_Lantai,Kode_Gedung From Ruangan r inner join lantai l on l.id=r.Kode_lantai inner join Gedung g on g.id=l.kode_gedung Where r.Kode_Lantai= :kode_lantai or :kode_lantai2 = '' ",[":kode_lantai"=>$req->id_lantai ?? "",":kode_lantai2"=>$req->id_lantai ??""]);
        $gedung = Gedung::where("id",$req->kode_gedung ?? "")->get();
        $lantai = Lantai::where("id",$req->id_lantai ?? "" )->get();
        $ruangan = Ruangan::where("Kode_Ruangan",$req->kode_ruangan ?? "")->get();
        return ["listGedung"=>$listGedung,"listLantai"=>$listLantai,"listRuangan"=>$listRuangan,"gedung"=>$gedung,"lantai"=>$lantai,"ruangan"=>$ruangan];
   }
}
