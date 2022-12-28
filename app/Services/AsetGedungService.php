<?php

namespace App\Services;

use App\Exports\AsetBarangExport;
use App\Exports\AsetGedungExport;
use App\Http\Requests\AsetGedungRequest;
use App\Http\Requests\DetailAsetGedungRequest;
use App\Http\Requests\LokasiRequest;
use App\Imports\AsetGedungImport;
use App\Models\DetailAsetGedung;
use App\Models\MasterAsetGedung;
use App\Models\MasterSatker;
use App\Models\Ruangan;
use DB;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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
    public function GetDetailDataTable(DetailAsetGedungRequest $request)
    {
        error_log(json_encode($request));
        $query = "Select * From Master_Aset_Gedung mag inner join Detail_Aset_Gedung dag on mag.Kode_Gedung=dag.Kode_Gedung inner join Master_Satker s on s.Kode_Satker=dag.Kode_Satker".
        " Where Tahun_Data=:tahun or :tahun2=''";
        $data = DB::select($query,[":tahun"=>$request->Tahun_Data,":tahun2"=>$request->Tahun_Data ?? ""]);
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

    public function InsertDetailAset(DetailAsetGedungRequest $req)
    {
        $existed = MasterAsetGedung::where('Kode_Gedung',$req->input("Kode_Gedung"));
        if ($existed->count() < 1  )
            return redirect()->back()->with(["Error"=>"Gedung dengan kode ini tidak ada"]);
        $data  = $req->all();
        $data["Tahun_Data"] = date('Y');
        $insert =  DetailAsetGedung::create($data);
    }
    public function UpdateDetailAset(String $id,DetailAsetGedungRequest $req)
    {
        $data = DetailAsetGedung::where("id",$id);
        if ($data->count() < 1)
            return redirect()->back()->with(["Error"=>"Gedung dengan kode ini tidak ada"]);
        $data->update($req->except("_token"));
    }
    public function DeleteDetailAset(String $id)
    {
        $data = DetailAsetGedung::where("id",$id);
        if ($data->count() < 1)
            return redirect()->back()->with(["Error"=>"Gedung dengan kode ini tidak ada"]);
        $data->delete();
    }
    public function RetrieveMasterGedung(string $nama)
    {
        $query = "Select Merk_Tipe,Kode_Gedung,Nama_Gedung From Master_Aset_Gedung where Nama_Gedung like :nama";
        $data = DB::select($query, [":nama"=>'%'.$nama.'%']);
        return response()->json($data);
    }
    public function RetrieveDetailAsetGedung(string $id)
    {
        $query = "Select * From Master_Aset_Gedung mag inner join Detail_Aset_Gedung dag on mag.Kode_Gedung=dag.Kode_Gedung inner join Master_Satker s on s.Kode_Satker=dag.Kode_Satker  where id=:id";
        $data = DB::select($query,[":id"=>$id]);
        return response()->json($data);
    }
    public function ImportData(LokasiRequest $req)
    {
        // return Excel::toCollection(new AsetBarangImport,$req->file("import_file"));
        Excel::import(new AsetGedungImport($req),$req->file("import_file"));
        return redirect()->back();
        /*$query = "Select mas.Kode_Satker as ' Kode Satker ',Nama_Satker as ' Nama Satker ',mab.Kode_Barang as ' Kode Barang ',Nama_Barang as ' Nama Barang ',NUP,Kondisi,Merk_Tipe as ' Merk Tipe ',Tgl_Rekam_Pertama as ' Tgl Rekam Pertama ',Tgl_Perolehan as ' Tgl Perolehan ',Nilai_Perolehan_Pertama as ' Nilai Perolehan Pertama ',Nilai_Mutasi as ' Nilai_Mutasi ',Nilai_Perolehan as 'Nilai Perolehan',Nilai_Penyusutan as 'Nilai_Penyusutan',Nilai_Buku as 'Nilai_Buku',KUANTITAS,Jml_foto as 'Jml Foto',Status_Penggunaan as ' Status Penggunaan ',Status_Pengelolaan as ' Status Pengelolaan ',No_Psp as ' NO PSP ',Tgl_PSP as ' Tgl PSP',Jumlah_KIB as 'Jumlah KIB',g.Nama_gedung as 'Gedung',l.No_Lantai as 'Lantai',r.Nama_ruangan as 'Ruangan' From Master_aset_barang mab inner join Detail_Aset_barang dab on mab.kode_barang=dab.kode_barang inner join master_satker mas on mas.kode_satker=dab.kode_satker inner join ruangan r on r.kode_ruangan=dab.kode_ruangan inner join lantai l on r.kode_lantai=l.id inner join gedung g on g.id=l.kode_gedung ".
        " Where (g.id = :kode_gedung or :kode_gedung2 ='') and (l.id= :id_lantai or :id_lantai2 ='') and (r.Kode_Ruangan= :kode_ruangan or :kode_ruangan2 ='')";
        $data = DB::select($query, [":kode_gedung"=>$req->kode_gedung ?? "",":id_lantai"=>$req->id_lantai ?? "",":kode_ruangan"=>$req->kode_ruangan ?? "" ,":kode_gedung2"=>$req->kode_gedung ?? "",":id_lantai2"=>$req->id_lantai ?? "",":kode_ruangan2"=>$req->kode_ruangan ?? ""]);*/

    }
    public function ExportData($year)
    {
        $name = "Data-Aset-Gedung-". ($year ?? "ALL").".xlsx";
        return Excel::download(new AsetGedungExport($year),$name);
    }
    public function GetYears()
    {
        $query = "Select DISTINCT Tahun_Data From Detail_Aset_Gedung";
        $data = DB::select($query);
        return $data;
    }

}
