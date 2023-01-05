<?php

namespace App\Imports;

use App\Http\Requests\LokasiRequest;
use App\Models\DetailAsetBarang;
use Illuminate\Support\Str;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\Ruangan;
use App\Models\MasterAsetBarang;
use App\Models\MasterSatker;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Request;

class AsetBarangImport implements ToCollection,WithCalculatedFormulas
{
    private LokasiRequest $req;
    public function __construct(LokasiRequest $req)
    {
        $this->req = $req;
    }
    public function mapping() : array
    {
        return [
            'No' => 'A1',
            'Kode_Satker' => 'B1',
            'Nama_Satker' => 'C1',
            'Kode_Barang' => 'D1',
            'Nama_Barang' => 'E1',
            'NUP' => 'F1',
            'Kondisi' => 'G1',
            'Merk_Tipe' => 'H1',
            'Tgl_Rekam_Pertama' => 'I1',
            'Tgl_Perolehan' => 'J1',
            'Nilai_Perolehan_Pertama' => 'K1',
            'Nilai_Mutasi' => 'L1',
            'Nilai_Perolehan' => 'M1',
            'Nilai_Penyusutan' => 'N1',
            'Nilai_Buku' => 'O1',
            'KUANTITAS' => 'P1',
            'Jml_Foto' => 'Q1',
            'Status_Penggunaan' => 'R1',
            'Status_Pengelolaan' => 'S1',
            'No_PSP' => 'T1',
            'Tgl_PSP' => 'U1',
            'Jumlah_KIB' => 'V1',
            'Nama_Gedung' => 'W1',
            'No_Lantai' => 'X1',
            'Nama_Ruangan' => 'Y1',
        ];
    }
    public function getMap() : array
    {
        return ['No','Kode_Satker','Nama_Satker','Kode_Barang','Nama_Barang','NUP','Kondisi','Merk_Tipe','Tgl_Rekam_Pertama','Tgl_Perolehan','Nilai_Perolehan_Pertama','Nilai_Mutasi','Nilai_Perolehan','Nilai_Penyusutan','Nilai_Buku','Kuantitas','Jml_Foto','Status_Penggunaan','Status_Pengelolaan','No_PSP','Tgl_PSP','Jumlah_KIB','Nama_Gedung','No_Lantai','Nama_Ruangan'   ];
    }
    public function CreateMapCollection(Collection $list)
    {
        $ret = [];
        $cols = $this->getMap();
        foreach ($list as $item)
        {
            $data = (array)$item;
            $temp = [];
            for ($i=0;$i<count($data);$i++)
            {
                $temp[$cols[$i]] = $data[$i] ?? "";
            }
            array_push($ret,$temp);
        }
        return collect($ret);
    }
    /**
    * @param Collection $collection
    */

    public function collection(Collection $collection)
    {
        $collection = $collection->forget(0);
        $collection = collect($collection->toArray(null, true));
        $collection = $this->CreateMapCollection($collection);
        foreach ($collection as $item)
        {
            $this->HandleSatker(collect($item) );
            $this->HandleMaster(collect($item));
            $kode_ruangan = $this->HandleLokasi(collect($item));
            $data = collect($item)->only(['Kode_Barang','Kode_Satker','NUP', 'Kondisi', 'Tgl_Rekam_Pertama', 'Tgl_Perolehan', 'Nilai_Perolehan_Pertama', 'Nilai_Mutasi', 'Nilai_Perolehan', 'Nilai_Penyusutan', 'Nilai_Buku', 'Kuantitas', 'Jml_Foto', 'Status_Penggunaan', 'Status_Pengelolaan', 'No_PSP', 'Tgl_PSP', 'Jumlah_KIB'])->toArray();
            $data["Kode_Ruangan"] = $kode_ruangan;
            $data["Tgl_PSP"] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((int)$data["Tgl_PSP"]);
            $data["Tgl_Perolehan"] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((int)$data["Tgl_Perolehan"]);
            $data["Tgl_Rekam_Pertama"] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((int)$data["Tgl_Rekam_Pertama"]);
            $data["Tahun_Data"] = $this->req->Tahun;
            error_log(json_encode($data));
            DetailAsetBarang::create($data);
        }
    }
    public function HandleSatker(Collection $data)
    {
        $item = $data->only(["Kode_Satker","Nama_Satker"])->toArray();
        error_log(json_encode($data ));
        $existed = MasterSatker::where("Kode_Satker","=",$item["Kode_Satker"]);
        if ($existed->count() > 0)
            return;
        MasterSatker::create(["Kode_Satker"=>$item["Kode_Satker"],"Nama_Satker"=>$item["Nama_Satker"]]);
    }
    public function HandleMaster(Collection $data)
    {
        $item = $data->only(["Kode_Barang","Nama_Barang","Merk_Tipe"])->toArray();
        $existed = MasterAsetBarang::where("Kode_Barang","=",$item);
        if ($existed->count() > 0)
            return;
        MasterAsetBarang::create($item);
    }
    public function HandleLokasi(Collection $data)
    {
        $item = $data->only(["Nama_Gedung","No_Lantai","Nama_Ruangan"])->toArray(null,true);
        $gedung = Gedung::where("Nama_Gedung","=",$data["Nama_Gedung"]);
        $dataGedung = $gedung->get()->first();
        if ($gedung->count() < 1)
        {
            $dataGedung = Gedung::Create(["Nama_Gedung"=>$data["Nama_Gedung"]]);
        }
        error_log(json_encode($dataGedung));
        $lantai = Lantai::where([["Kode_Gedung",'=',$dataGedung->id],["No_Lantai",'=',$data["No_Lantai"]]]);
        $dataLantai = $lantai->get()->first();
        if ($lantai->count() < 1)
        {
            $dataLantai = Lantai::create(["Kode_Gedung"=>$dataGedung->id,"no_lantai"=>$data["No_Lantai"]]);
        }
        $ruangan = Ruangan::where([["Kode_Lantai",'=',$dataLantai->id],["Nama_Ruangan",'=',$data["Nama_Ruangan"]]]);
        $dataRuangan  = $ruangan->get()->first();
        if ($ruangan->count() < 1)
        {
            $dataRuangan = Ruangan::create(["Kode_Lantai"=>$dataLantai->id,"Nama_Ruangan"=>$data["Nama_Ruangan"],"Kode_Ruangan"=>Str::random(16)]);
        }
        return $dataRuangan->Kode_Ruangan;
    }
}
