<?php

namespace App\Exports;

use App\Http\Requests\LokasiRequest;
use App\Services\LokasiService;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class AsetBarangExport implements FromCollection
{
    private LokasiRequest $req;
    private $year;
    public function __construct(LokasiRequest $req,$year="")
    {
        $this->req = $req;
        $this->year = $year ?? "";
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $req = $this->req;
        $i= 1;
        $query = "Select mas.Kode_Satker as ' Kode Satker ',Nama_Satker as ' Nama Satker ',mab.Kode_Barang as ' Kode Barang ',Nama_Barang as ' Nama Barang ',NUP,Kondisi,Merk_Tipe as ' Merk Tipe ',Tgl_Rekam_Pertama as ' Tgl Rekam Pertama ',Tgl_Perolehan as ' Tgl Perolehan ',Nilai_Perolehan_Pertama as ' Nilai Perolehan Pertama ',Nilai_Mutasi as ' Nilai_Mutasi ',Nilai_Perolehan as 'Nilai Perolehan',Nilai_Penyusutan as 'Nilai_Penyusutan',Nilai_Buku as 'Nilai_Buku',KUANTITAS,Jml_foto as 'Jml Foto',Status_Penggunaan as ' Status Penggunaan ',Status_Pengelolaan as ' Status Pengelolaan ',No_Psp as ' NO PSP ',Tgl_PSP as ' Tgl PSP',Jumlah_KIB as 'Jumlah KIB',g.Nama_gedung as 'Gedung',l.No_Lantai as 'Lantai',r.Nama_ruangan as 'Ruangan' From Master_aset_barang mab inner join Detail_Aset_barang dab on mab.kode_barang=dab.kode_barang inner join master_satker mas on mas.kode_satker=dab.kode_satker inner join ruangan r on r.kode_ruangan=dab.kode_ruangan inner join lantai l on r.kode_lantai=l.id inner join gedung g on g.id=l.kode_gedung "
        ." Where Tahun_Data=:tahun or :tahun2=''";
      //  " Where (g.id = :kode_gedung or :kode_gedung2 ='') and (l.id= :id_lantai or :id_lantai2 ='') and (r.Kode_Ruangan= :kode_ruangan or :kode_ruangan2 ='')";
        $data = DB::select($query,[":tahun"=>$this->year,":tahun2"=>$this->year]);// [":kode_gedung"=>$req->kode_gedung ?? "",":id_lantai"=>$req->id_lantai ?? "",":kode_ruangan"=>$req->kode_ruangan ?? "" ,":kode_gedung2"=>$req->kode_gedung ?? "",":id_lantai2"=>$req->id_lantai ?? "",":kode_ruangan2"=>$req->kode_ruangan ?? ""]);
        $ret = [];
        foreach ($data as $t)
        {
            $temp= json_decode(json_encode($t),true);
            array_unshift($temp,$i);
            $i = $i+1;

            array_push($ret,(object)$temp);
        }
        array_unshift($ret,['No', 'Kode Satker', 'Nama Satker', 'Kode Barang', 'Nama Barang', 'NUP', 'Kondisi', 'Merk\\/Tipe', 'Tgl Rekam Pertama', 'Tgl Perolehan', 'Nilai Perolehan Pertama', 'Nilai Mutasi', 'Nilai Perolehan', 'Nilai Penyusutan', 'Nilai Buku', 'KUANTITAS', 'Jml Foto', 'Status Penggunaan', 'Status Pengelolaan', 'No PSP', 'Tgl PSP', 'Jumlah KIB', 'Gedung', 'Lantai', 'Ruangan']);
        return collect($ret);
    }
}
