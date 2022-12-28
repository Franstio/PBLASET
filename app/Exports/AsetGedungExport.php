<?php

namespace App\Exports;

use App\Http\Requests\LokasiRequest;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class AsetGedungExport implements FromCollection
{
    private $year;
    public function __construct($year)
    {
        $this->year = $year;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $i= 1;
        $query = "Select mas.Kode_Satker as ' Kode Satker ',Nama_Satker as ' Nama Satker ',mag.Kode_Gedung as ' Kode Gedung',mag.Nama_Gedung as ' Nama Gedung ',NUP,Kondisi,Merk_Tipe as ' Merk Tipe ',Tgl_Rekam_Pertama as ' Tgl Rekam Pertama ',Tgl_Perolehan as ' Tgl Perolehan ',Nilai_Perolehan_Pertama as ' Nilai Perolehan Pertama ',Nilai_Mutasi as ' Nilai_Mutasi ',Nilai_Perolehan as 'Nilai Perolehan',Nilai_Penyusutan as 'Nilai_Penyusutan',Nilai_Buku as 'Nilai_Buku',KUANTITAS,Jml_foto as 'Jml Foto',Status_Penggunaan as ' Status Penggunaan ',Status_Pengelolaan as ' Status Pengelolaan ',No_Psp as ' NO PSP ',Tgl_PSP as ' Tgl PSP',Jumlah_KIB as 'Jumlah KIB',Dokumen,Concat(Luas_Bangunan,'m') as 'Luas Bangunan',Concat(Luas_Dasar_Bangunan,'m') as 'Luas Dasar Bangunan',Jumlah_Lantai as 'Jumlah Lantai',Jalan,Kode_Kab_Kota as 'Kode Kabupaten Kota',Uraian_Kab_Kota as 'Uraian Kabupaten Kota',Kode_Provinsi as 'Kode Provinsi',Uraian_Provinsi as 'Uraian Provinsi',Kode_Pos as 'Kode Pos',SBSK,Optimalisasi,Status_SBSN as 'Status SBSN' From Master_aset_gedung mag inner join Detail_Aset_Gedung dag on mag.kode_gedung=dag.kode_gedung inner join master_satker mas on mas.kode_satker=dag.kode_satker "
        ." Where dag.Tahun_Data=:tahun or :tahun2=''";
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
        array_unshift($ret,['No', 'Kode Satker', 'Nama Satker', 'Kode Gedung', 'Nama Gedung', 'NUP', 'Kondisi', 'Merk Tipe', 'Tgl Rekam Pertama', 'Tgl Perolehan', 'Nilai Perolehan Pertama', 'Nilai Mutasi', 'Nilai Perolehan', 'Nilai Penyusutan', 'Nilai Buku', 'KUANTITAS', 'Jml Foto', 'Status Penggunaan', 'Status Pengelolaan', 'No PSP', 'Tgl PSP', 'Jumlah KIB', "Dokumen","Luas Bangunan","Luas Dasar Bangunan","Jumlah Lantai","Jalan","Kode Kabupaten Kota","Uraian Kabupaten Kota","Kode Provinsi","Uraian Provinsi","Kode POS","SBSK","Optimalisasi","Status SBSN"]);
        return collect($ret);
    }
}
