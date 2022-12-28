<?php

namespace App\Imports;

use App\Http\Requests\LokasiRequest;
use App\Models\DetailAsetGedung;
use App\Models\MasterAsetGedung;
use App\Models\MasterSatker;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AsetGedungImport implements ToCollection
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
            'Kode_Barang    ' => 'D1',
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
        return ['No','Kode_Satker','Nama_Satker','Kode_Gedung','Nama_Gedung','NUP','Kondisi',"Dokumen",'Merk_Tipe','Tgl_Rekam_Pertama','Tgl_Perolehan','Nilai_Perolehan_Pertama','Nilai_Mutasi','Nilai_Perolehan','Nilai_Penyusutan','Nilai_Buku','Kuantitas',"Luas_Bangunan","Luas_Dasar_Bangunan","Jumlah_Lantai",'Jml_Foto',"Jalan","Kode_Kab_Kota","Uraian_Kab_Kota","Kode_Provinsi","Uraian_Provinsi","Kode_Pos",'Status_Penggunaan','Status_Pengelolaan','No_PSP','Tgl_PSP','Jumlah_KIB',"SBSK","Optimalisasi","Status_SBSN"];
    }
    public function CreateMapCollection(Collection $list)
    {
        $ret = [];
        $cols = $this->getMap();
        foreach ($list as $item)
        {
            $data = $item->toArray();
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
        $collection = $this->CreateMapCollection($collection);
        foreach ($collection as $item)
        {
            $this->HandleSatker(collect($item) );
            $this->HandleMaster(collect($item));
            $data = collect($item)->only(['Kode_Gedung','Kode_Satker','NUP', 'Kondisi', 'Tgl_Rekam_Pertama', 'Tgl_Perolehan', 'Nilai_Perolehan_Pertama', 'Nilai_Mutasi', 'Nilai_Perolehan', 'Nilai_Penyusutan', 'Nilai_Buku', 'Kuantitas', 'Jml_Foto', 'Status_Penggunaan', 'Status_Pengelolaan', 'No_PSP', 'Tgl_PSP', 'Jumlah_KIB',"Dokumen","Luas_Bangunan","Luas_Dasar_Bangunan","Jumlah_Lantai","Jalan","Kode_Kab_Kota","Uraian_Kab_Kota","Kode_Provinsi","Uraian_Provinsi","Kode_Pos","SBSK","Optimalisasi","Status_SBSN"])->toArray();
            $data["Tgl_PSP"] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((int)$data["Tgl_PSP"]);
            $data["Tgl_Perolehan"] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((int)$data["Tgl_Perolehan"]);
            $data["Tgl_Rekam_Pertama"] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((int)$data["Tgl_Rekam_Pertama"]);
            $data["Tahun_Data"] = $this->req->Tahun;
            error_log(json_encode($data));
            DetailAsetGedung::create($data);
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
        $item = $data->only(["Kode_Gedung","Nama_Gedung","Merk_Tipe"])->toArray();
        $existed = MasterAsetGedung::where("Kode_Gedung","=",$item);
        if ($existed->count() > 0)
            return;
        MasterAsetGedung::create($item);
    }
}
