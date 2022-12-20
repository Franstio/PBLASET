<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\DetailAsetBarang
 *
 * @property int $id
 * @property int $NUP
 * @property string $Kondisi
 * @property string $Tgl_Rekam_Pertama
 * @property string $Tgl_Perolehan
 * @property string $Nilai_Perolehan_Pertama
 * @property string $Nilai_Mutasi
 * @property string $Nilai_Perolehan
 * @property string $Nilai_Penyusutan
 * @property string $Nilai_Buku
 * @property string $Kuantitas
 * @property int $jml_foto
 * @property string $Status_Penggunaan
 * @property string $Status_Pengelolaan
 * @property string $No_PSP
 * @property string $Tgl_PSP
 * @property int $Jumlah_KIB
 * @property string $Kode_Barang
 * @property string $Kode_Ruangan
 * @property string $Kode_Satker
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang query()
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereJmlFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereJumlahKIB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereKodeBarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereKodeRuangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereKodeSatker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereKondisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereKuantitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereNUP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereNilaiBuku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereNilaiMutasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereNilaiPenyusutan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereNilaiPerolehan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereNilaiPerolehanPertama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereNoPSP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereStatusPengelolaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereStatusPenggunaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereTglPSP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereTglPerolehan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetBarang whereTglRekamPertama($value)
 */
	class DetailAsetBarang extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DetailAsetGedung
 *
 * @property int $id
 * @property int $NUP
 * @property string $Kondisi
 * @property string $Jenis
 * @property string $Tgl_Rekam_Pertama
 * @property string $Tgl_Perolehan
 * @property string $Nilai_Perolehan_Pertama
 * @property string $Nilai_Mutasi
 * @property string $Nilai_Perolehan
 * @property string $Nilai_Penyusutan
 * @property string $Nilai_Buku
 * @property string $Kuantitas
 * @property int $jml_foto
 * @property string $Status_Penggunaan
 * @property string $Status_Pengelolaan
 * @property string $No_PSP
 * @property string $Tgl_PSP
 * @property int $Jumlah_KIB
 * @property string $Dokumen
 * @property string $Luas_Bangunan
 * @property string $Luas_Dasar_Bangunan
 * @property int $Jumlah_Lantai
 * @property string $Jalan
 * @property string $Kode_Kab_Kota
 * @property string $Uraian_Kab_Kota
 * @property string $Kode_Pos
 * @property int $SBSK
 * @property int $Optimalisasi
 * @property string $Status_SBSN
 * @property string $Uraian_Provinsi
 * @property string $Kode_Provinsi
 * @property string $Merk_Tipe
 * @property string $Kode_Gedung
 * @property string $Kode_Satker
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung query()
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereJalan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereJenis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereJmlFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereJumlahKIB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereJumlahLantai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereKodeGedung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereKodeKabKota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereKodePos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereKodeProvinsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereKodeSatker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereKondisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereKuantitas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereLuasBangunan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereLuasDasarBangunan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereMerkTipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereNUP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereNilaiBuku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereNilaiMutasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereNilaiPenyusutan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereNilaiPerolehan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereNilaiPerolehanPertama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereNoPSP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereOptimalisasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereSBSK($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereStatusPengelolaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereStatusPenggunaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereStatusSBSN($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereTglPSP($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereTglPerolehan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereTglRekamPertama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereUraianKabKota($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailAsetGedung whereUraianProvinsi($value)
 */
	class DetailAsetGedung extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Gedung
 *
 * @property string $Nama_Gedung
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|Gedung newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gedung newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gedung query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gedung whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gedung whereNamaGedung($value)
 */
	class Gedung extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Lantai
 *
 * @property int $no_lantai
 * @property int $id
 * @property int $Kode_Gedung
 * @method static \Illuminate\Database\Eloquent\Builder|Lantai newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lantai newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lantai query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lantai whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lantai whereKodeGedung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lantai whereNoLantai($value)
 */
	class Lantai extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MasterAsetBarang
 *
 * @property string $Merk_Tipe
 * @property string $Nama_Barang
 * @property string $Kode_Barang
 * @method static \Illuminate\Database\Eloquent\Builder|MasterAsetBarang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterAsetBarang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterAsetBarang query()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterAsetBarang whereKodeBarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterAsetBarang whereMerkTipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterAsetBarang whereNamaBarang($value)
 */
	class MasterAsetBarang extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MasterAsetGedung
 *
 * @property string $Nama_Gedung
 * @property string $Kode_Gedung
 * @property string $Merk_Tipe
 * @method static \Illuminate\Database\Eloquent\Builder|MasterAsetGedung newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterAsetGedung newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterAsetGedung query()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterAsetGedung whereKodeGedung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterAsetGedung whereMerkTipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterAsetGedung whereNamaGedung($value)
 */
	class MasterAsetGedung extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MasterSatker
 *
 * @property string $Nama_Satker
 * @property int $Kode_Satker
 * @method static \Illuminate\Database\Eloquent\Builder|MasterSatker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterSatker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterSatker query()
 * @method static \Illuminate\Database\Eloquent\Builder|MasterSatker whereKodeSatker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MasterSatker whereNamaSatker($value)
 */
	class MasterSatker extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ruangan
 *
 * @property string $Nama_Ruangan
 * @property int $Kode_Lantai
 * @property string $Kode_Ruangan
 * @method static \Illuminate\Database\Eloquent\Builder|Ruangan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ruangan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ruangan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ruangan whereKodeLantai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruangan whereKodeRuangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ruangan whereNamaRuangan($value)
 */
	class Ruangan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\test
 *
 * @method static \Illuminate\Database\Eloquent\Builder|test newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|test newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|test query()
 */
	class test extends \Eloquent {}
}

