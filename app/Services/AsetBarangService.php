<?php

namespace App\Services;

use App\Http\Requests\AsetBarangRequest;
use App\Http\Requests\DetailAsetBarangRequest;
use App\Models\DetailAsetBarang;
use App\Models\MasterAsetBarang;
use App\Models\MasterSatker;
use App\Models\Ruangan;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DB;
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
    public function GetDetailDataTable(DetailAsetBarangRequest $request)
    {

        $query = "Select * From Master_Aset_Barang mab inner join Detail_Aset_Barang dab on mab.Kode_Barang=dab.Kode_Barang inner join Master_Satker s on s.Kode_Satker=dab.Kode_Satker inner join (select Concat(Nama_Gedung,', Lantai-',no_lantai,', ',Nama_Ruangan,' ( ',KOde_Ruangan,' ) ') as Lokasi,Kode_Ruangan,Nama_Ruangan From Ruangan inner join Lantai on RUangan.Kode_Lantai=Lantai.id inner join Gedung on Gedung.id=Lantai.KOde_Gedung) tbl_lokasi on dab.Kode_Ruangan=tbl_lokasi.Kode_Ruangan";
        $data = DB::select($query);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $json = json_encode($row);
                $id = $row->id;
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
    public function GetDBR(Request $request)
    {

        $query = "Select tbl_lokasi.Lokasi,mab.Kode_Barang,Nama_Barang,Nilai_Mutasi,NUP,Merk_Tipe From Master_Aset_Barang mab inner join Detail_Aset_Barang dab on mab.Kode_Barang=dab.Kode_Barang inner join Master_Satker s on s.Kode_Satker=dab.Kode_Satker inner join (select Concat(Nama_Gedung,', Lantai-',no_lantai,', ',Nama_Ruangan,' ( ',KOde_Ruangan,' ) ') as Lokasi,Kode_Ruangan,Nama_Ruangan From Ruangan inner join Lantai on RUangan.Kode_Lantai=Lantai.id inner join Gedung on Gedung.id=Lantai.KOde_Gedung) tbl_lokasi on dab.Kode_Ruangan=tbl_lokasi.Kode_Ruangan";
        $data = DB::select($query);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('QR', function($row){
                $json = json_encode($row);
                $btn = QrCode::size(100)->generate($json);
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function InsertDetailAset(DetailAsetBarangRequest $req)
    {
        $existed = MasterAsetBarang::where('Kode_Barang',$req->input("Kode_Barang"));
        $existedLoc = Ruangan::where("Kode_Ruangan",$req->input("Kode_Ruangan"));
        if ($existed->count() < 1  || $existedLoc->count() < 1)
            return redirect()->back()->with(["Error"=>"Barang dengan kode ini tidak ada"]);
        $insert =  DetailAsetBarang::create($req->all());
    }
    public function UpdateDetailAset(String $id,DetailAsetBarangRequest $req)
    {
        $data = DetailAsetBarang::where("id",$id);
        if ($data->count() < 1)
            return redirect()->back()->with(["Error"=>"Barang dengan kode ini tidak ada"]);
        $data->update($req->except("_token"));
    }
    public function DeleteDetailAset(String $id)
    {
        $data = DetailAsetBarang::where("id",$id);
        if ($data->count() < 1)
            return redirect()->back()->with(["Error"=>"Barang dengan kode ini tidak ada"]);
        $data->delete();
    }
    public function RetrieveMasterBarang(string $nama)
    {
        $query = "Select Merk_Tipe,Kode_Barang,Nama_Barang From Master_Aset_Barang where Nama_Barang like :nama";
        $data = DB::select($query, [":nama"=>'%'.$nama.'%']);
        return response()->json($data);
    }
    public function RetrieveDetailAsetBarang(string $id)
    {
        $query = "Select * From Master_Aset_Barang mab inner join Detail_Aset_Barang dab on mab.Kode_Barang=dab.Kode_Barang inner join Master_Satker s on s.Kode_Satker=dab.Kode_Satker inner join (select Concat(Nama_Gedung,', Lantai-',no_lantai,', ',Nama_Ruangan,' ( ',KOde_Ruangan,' ) ') as Lokasi,Kode_Ruangan From Ruangan inner join Lantai on RUangan.Kode_Lantai=Lantai.id inner join Gedung on Gedung.id=Lantai.KOde_Gedung) tbl_lokasi on dab.Kode_Ruangan=tbl_lokasi.Kode_Ruangan where id=:id";
        $data = DB::select($query,[":id"=>$id]);
        return response()->json($data);
    }

}
