<?php

namespace App\Services;

use App\Exports\AsetBarangExport;
use App\Http\Requests\AsetBarangRequest;
use App\Http\Requests\DetailAsetBarangRequest;
use App\Http\Requests\LokasiRequest;
use App\Imports\AsetBarangImport;
use App\Models\DetailAsetBarang;
use App\Models\MasterAsetBarang;
use App\Models\MasterSatker;
use App\Models\Ruangan;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DB;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Facades\Excel;

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
        error_log(json_encode($request));
        $query = "Select * From Master_Aset_Barang mab inner join Detail_Aset_Barang dab on mab.Kode_Barang=dab.Kode_Barang inner join Master_Satker s on s.Kode_Satker=dab.Kode_Satker inner join (select Concat(Nama_Gedung,', Lantai-',no_lantai,', ',Nama_Ruangan,' ( ',KOde_Ruangan,' ) ') as Lokasi,Kode_Ruangan,Nama_Ruangan From Ruangan inner join Lantai on RUangan.Kode_Lantai=Lantai.id inner join Gedung on Gedung.id=Lantai.KOde_Gedung) tbl_lokasi on dab.Kode_Ruangan=tbl_lokasi.Kode_Ruangan".
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
    public function GetDBR(Request $request)
    {
        DB::enableQueryLog();
        $temp = $request->draw;
        $temp2 = $request->start;
        $s = $request->search["value"];
        $query = "Select tbl_lokasi.Lokasi,mab.Kode_Barang,Nama_Barang,Nilai_Perolehan_Pertama,NUP,Merk_Tipe From Master_Aset_Barang mab inner join Detail_Aset_Barang dab on mab.Kode_Barang=dab.Kode_Barang inner join Master_Satker s on s.Kode_Satker=dab.Kode_Satker inner join (select Concat(Nama_Gedung,', Lantai-',no_lantai,', ',Nama_Ruangan,' ( ',KOde_Ruangan,' ) ') as Lokasi,Kode_Ruangan,Nama_Ruangan,Lantai.id as Kode_Lantai,Lantai.No_Lantai,Gedung.id as Kode_Gedung,Gedung.Nama_Gedung From Ruangan inner join Lantai on RUangan.Kode_Lantai=Lantai.id inner join Gedung on Gedung.id=Lantai.KOde_Gedung) tbl_lokasi on dab.Kode_Ruangan=tbl_lokasi.Kode_Ruangan".
        " Where (:year2= '' or dab.Tahun_Data=:year) and (tbl_lokasi.Kode_Gedung= :kode_gedung or :kode_gedung2='') and (tbl_lokasi.Kode_Lantai= :kode_lantai or :kode_lantai2='') and (tbl_lokasi.Kode_Ruangan=:kode_ruangan or :kode_ruangan2='')  and (mab.Kode_Barang like :kode_barang   or mab.Nama_Barang like :nama_barang ) LIMIT ". ($request->start ) . ",". ($request->length);
        $query_count = "Select count(*) as RecordTotal From Master_Aset_Barang mab inner join Detail_Aset_Barang dab on mab.Kode_Barang=dab.Kode_Barang inner join Master_Satker s on s.Kode_Satker=dab.Kode_Satker inner join (select Concat(Nama_Gedung,', Lantai-',no_lantai,', ',Nama_Ruangan,' ( ',KOde_Ruangan,' ) ') as Lokasi,Kode_Ruangan,Nama_Ruangan,Lantai.id as Kode_Lantai,Lantai.No_Lantai,Gedung.id as Kode_Gedung,Gedung.Nama_Gedung From Ruangan inner join Lantai on RUangan.Kode_Lantai=Lantai.id inner join Gedung on Gedung.id=Lantai.KOde_Gedung) tbl_lokasi on dab.Kode_Ruangan=tbl_lokasi.Kode_Ruangan".
        " Where (:year2='' or dab.Tahun_Data=:year) and (tbl_lokasi.Kode_Gedung= :kode_gedung or :kode_gedung2='') and (tbl_lokasi.Kode_Lantai= :kode_lantai or :kode_lantai2='') and (tbl_lokasi.Kode_Ruangan=:kode_ruangan or :kode_ruangan2='') and (mab.Kode_Barang like :kode_barang   or mab.Nama_Barang like :nama_barang );";
        $data = DB::select($query,[":year"=>$request->year ??"" ,":year2"=>$request->year ?? "",":kode_gedung"=>$request->kode_gedung ??"",":kode_lantai"=>$request->id_lantai ?? "",":kode_ruangan"=>$request->kode_ruangan ?? "",":kode_gedung2"=>$request->kode_gedung ?? "",":kode_lantai2"=>$request->id_lantai ?? "",":kode_ruangan2"=>$request->kode_ruangan ?? "",":nama_barang"=>"%".($request->search["value"] ?? "")."%",":kode_barang"=>"%".($request->search['value'] ?? "")."%"]);
        $records = DB::select($query_count,[":year"=>$request->year ??"" ,":year2"=>$request->year ?? "",":kode_gedung"=>$request->kode_gedung ??"",":kode_lantai"=>$request->id_lantai ?? "",":kode_ruangan"=>$request->kode_ruangan ?? "",":kode_gedung2"=>$request->kode_gedung ?? "",":kode_lantai2"=>$request->id_lantai ?? "",":kode_ruangan2"=>$request->kode_ruangan ?? "",":nama_barang"=>"%".($request->search["value"] ?? "")."%",":kode_barang"=>"%".($request->search['value'] ?? "")."%"]);
        $q = DB::getQueryLog();
        $request->draw = 1;
        $request->start = 1;
        $ret =  DataTables::of($data)
            ->skipPaging()
            ->addIndexColumn()
            ->addColumn('QR', function($row){
                $json = $this->WriteDBR($row);
                $btn = QrCode::size(100)->generate($json);
                return $btn;
            })
            ->setTotalRecords($records[0]->RecordTotal)
            ->setFilteredRecords($records[0]->RecordTotal)

            ->rawColumns(['action'])
            ->make(true);
        $request->draw   = $temp;
        $request->start = $temp2;
        return $ret;
    }
    public function GetRawDBR(Request $request)
    {
        $query = "Select tbl_lokasi.Lokasi,mab.Kode_Barang,Nama_Barang,Nilai_Perolehan_Pertama,NUP,Merk_Tipe From Master_Aset_Barang mab inner join Detail_Aset_Barang dab on mab.Kode_Barang=dab.Kode_Barang inner join Master_Satker s on s.Kode_Satker=dab.Kode_Satker inner join (select Concat(Nama_Gedung,', Lantai-',no_lantai,', ',Nama_Ruangan,' ( ',KOde_Ruangan,' ) ') as Lokasi,Kode_Ruangan,Nama_Ruangan,Lantai.id as Kode_Lantai,Lantai.No_Lantai,Gedung.id as Kode_Gedung,Gedung.Nama_Gedung From Ruangan inner join Lantai on RUangan.Kode_Lantai=Lantai.id inner join Gedung on Gedung.id=Lantai.KOde_Gedung) tbl_lokasi on dab.Kode_Ruangan=tbl_lokasi.Kode_Ruangan".
        " Where (:year2='' or dab.Tahun_Data=:year) and (tbl_lokasi.Kode_Gedung= :kode_gedung or :kode_gedung2='') and (tbl_lokasi.Kode_Lantai= :kode_lantai or :kode_lantai2='') and (tbl_lokasi.Kode_Ruangan=:kode_ruangan or :kode_ruangan2='')";
        $data = DB::select($query,[":year"=>$request->year ??"" ,":year2"=>$request->year ?? "",":kode_gedung"=>$request->kode_gedung ??"",":kode_lantai"=>$request->id_lantai ?? "",":kode_ruangan"=>$request->kode_ruangan ?? "",":kode_gedung2"=>$request->kode_gedung ?? "",":kode_lantai2"=>$request->id_lantai ?? "",":kode_ruangan2"=>$request->kode_ruangan ?? ""]);
        return $data;
    }
    private function WriteDBR($data)
    {
        return "Lokasi: ".$data->Lokasi."\tKode Barang: ".$data->Kode_Barang."\n".
        "Nama Barang: ".$data->Nama_Barang."\tHarga (Nilai Mutasi): ".$data->Nilai_Perolehan_Pertama.
        "\tNUP: ".$data->NUP."\tMerk Tipe:".$data->Merk_Tipe;
    }
    public function InsertDetailAset(DetailAsetBarangRequest $req)
    {
        $existed = MasterAsetBarang::where('Kode_Barang',$req->input("Kode_Barang"));
        $existedLoc = Ruangan::where("Kode_Ruangan",$req->input("Kode_Ruangan"));
        if ($existed->count() < 1  || $existedLoc->count() < 1)
            return redirect()->back()->with(["Error"=>"Barang dengan kode ini tidak ada"]);
        $data  = $req->all();
        $data["Tahun_Data"] = date('Y');
        $insert =  DetailAsetBarang::create($data);
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
    public function ImportData(LokasiRequest $req)
    {
        // return Excel::toCollection(new AsetBarangImport,$req->file("import_file"));
        Excel::import(new AsetBarangImport($req),$req->file("import_file"));
        return redirect()->back();
        /*$query = "Select mas.Kode_Satker as ' Kode Satker ',Nama_Satker as ' Nama Satker ',mab.Kode_Barang as ' Kode Barang ',Nama_Barang as ' Nama Barang ',NUP,Kondisi,Merk_Tipe as ' Merk Tipe ',Tgl_Rekam_Pertama as ' Tgl Rekam Pertama ',Tgl_Perolehan as ' Tgl Perolehan ',Nilai_Perolehan_Pertama as ' Nilai Perolehan Pertama ',Nilai_Mutasi as ' Nilai_Mutasi ',Nilai_Perolehan as 'Nilai Perolehan',Nilai_Penyusutan as 'Nilai_Penyusutan',Nilai_Buku as 'Nilai_Buku',KUANTITAS,Jml_foto as 'Jml Foto',Status_Penggunaan as ' Status Penggunaan ',Status_Pengelolaan as ' Status Pengelolaan ',No_Psp as ' NO PSP ',Tgl_PSP as ' Tgl PSP',Jumlah_KIB as 'Jumlah KIB',g.Nama_gedung as 'Gedung',l.No_Lantai as 'Lantai',r.Nama_ruangan as 'Ruangan' From Master_aset_barang mab inner join Detail_Aset_barang dab on mab.kode_barang=dab.kode_barang inner join master_satker mas on mas.kode_satker=dab.kode_satker inner join ruangan r on r.kode_ruangan=dab.kode_ruangan inner join lantai l on r.kode_lantai=l.id inner join gedung g on g.id=l.kode_gedung ".
        " Where (g.id = :kode_gedung or :kode_gedung2 ='') and (l.id= :id_lantai or :id_lantai2 ='') and (r.Kode_Ruangan= :kode_ruangan or :kode_ruangan2 ='')";
        $data = DB::select($query, [":kode_gedung"=>$req->kode_gedung ?? "",":id_lantai"=>$req->id_lantai ?? "",":kode_ruangan"=>$req->kode_ruangan ?? "" ,":kode_gedung2"=>$req->kode_gedung ?? "",":id_lantai2"=>$req->id_lantai ?? "",":kode_ruangan2"=>$req->kode_ruangan ?? ""]);*/

    }
    public function ExportData(LokasiRequest $req,$year=null)
    {
        return Excel::download(new AsetBarangExport($req,$year),"Data-Aset-".($year =="" ? "ALL" : $year).".xlsx");
    }
    public function GetYears()
    {
        $query = "Select DISTINCT Tahun_Data From Detail_Aset_Barang";
        $data = DB::select($query);
        return $data;
    }
    public function DeleteDataYears($year)
    {
        $query = "Delete From Detail_Aset_Barang Where Tahun_Data=:tahun";
        $res = DB::delete($query,[":tahun"=>$year]);
        return $res;
    }
}
