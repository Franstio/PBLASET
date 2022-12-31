<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DBRController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengolahanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\AsetBarangController;
use App\Http\Controllers\AsetGedungController;
use App\Http\Controllers\SatkerController;
use App\Http\Controllers\testing;
use App\Http\Requests\AsetBarangRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/resources/js/app.js',function(){
    return response()->redirectTo( Vite::asset('resources/js/app.js'));
});

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons');
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::get('testing',[testing::class,"index"]);

    //Route For PBL-ASET
    Route::get("dashboard",[DashboardController::class,'index'])->name("dashboard");
    Route::get("pengolahan/{year?}",[PengolahanController::class,'list'])->name("pengolahan");
    Route::get("DBR/{year?}",[DBRController::class,"index"])->name("DBR");

    Route::get("aset-barang/master",[AsetBarangController::class,"master_index"])->name("master-aset-barang-index");
    Route::post('aset-barang/master/create',[AsetBarangController::class,"tambah_data_master"])->name("tambah-master-aset-barang");
    Route::get('aset-barang/master/read',[AsetBarangController::class,"get_data_master"])->name("get-master-barang");
    Route::post('aset-barang/master/update/{kode_barang}',[AsetBarangController::class,"update_data_master"])->name("update-master-aset-barang");
    Route::delete('aset-barang/master/delete/{kode_barang}',[AsetBarangController::class,'delete_data_master'])->name('delete-master-aset-barang');


    Route::get('satker',[SatkerController::class,"index"])->name("master.satker");
    Route::post('satker/create',[SatkerController::class,"create"])->name("master.satker.create");
    Route::get('satker/read',[SatkerController::class,"read"])->name("master.satker.read");
    Route::post('satker/update/{kode_satker}',[SatkerController::class,"update"])->name("master.satker.update");
    Route::delete('satker/delete/{kode_satker}',[SatkerController::class,'delete'])->name('master.satker.delete');
    Route::get("satker/list/{nama}",[SatkerController::class,"list"])->name("satker.list");
    Route::Get("satker/list",[SatkerController::class,"listAll"])->name("satker.list.all");

    Route::get('gedung',[AsetGedungController::class,"master_index"])->name("master.gedung");
    Route::post('gedung/create',[AsetGedungController::class,"tambah_data_master"])->name("master.gedung.create");
    Route::get('gedung/read',[AsetGedungController::class,"get_data_master"])->name("master.gedung.read");
    Route::post('gedung/update/{kode_gedung}',[AsetGedungController::class,"update_data_master"])->name("master.gedung.update");
    Route::delete('gedung/delete/{kode_gedung}',[AsetGedungController::class,'delete_data_master'])->name('master.gedung.delete');

    Route::get("lokasi/gedung",[LokasiController::class,"index"])->name("lokasi");
    Route::post("lokasi/gedung/create",[LokasiController::class,"CreateGedung"])->name("lokasi.gedung.create");
    Route::get("lokasi/gedung/read",[LokasiController::class,"ReadGedung"])->name("lokasi.gedung.read");
    Route::post("lokasi/gedung/update/{kode_gedung}",[LokasiController::class,"UpdateGedung"])->name("lokasi.gedung.update");
    Route::delete("lokasi/gedung/delete/{kode_gedung}",[LokasiController::class,"DeleteGedung"])->name("lokasi.gedung.delete");
    Route::get("lokasi/{lokasi?}",[LokasiController::class,"ListRuangan"])->name("lokasi.list");
    Route::get("lokasi/{nama_gedung}-{kode_gedung}/lantai",[LokasiController::class,"index_lantai"])->name("lokasi.lantai");
    Route::post("lokasi/{nama_gedung}-{kode_gedung}/lantai/create",[LokasiController::class,"CreateLantai"])->name("lokasi.lantai.create");
    Route::get("lokasi/{nama_gedung}-{kode_gedung}/lantai/read",[LokasiController::class,"ReadLantai"])->name("lokasi.lantai.read");
    Route::post("lokasi/{nama_gedung}-{kode_gedung}/lantai/update/{id}",[LokasiController::class,"UpdateLantai"])->name("lokasi.lantai.update");
    Route::delete("lokasi/{nama_gedung}-{kode_gedung}/lantai/delete/{id}",[LokasiController::class,"DeleteLantai"])->name("lokasi.lantai.delete");

    Route::get("lokasi/{nama_gedung}-{kode_gedung}/{no_lantai}-{kode_lantai}/ruangan",[LokasiController::class,"index_ruangan"])->name("lokasi.ruangan");
    Route::post("lokasi/{nama_gedung}-{kode_gedung}/{no_lantai}-{kode_lantai}/ruangan/create",[LokasiController::class,"CreateRuangan"])->name("lokasi.ruangan.create");
    Route::get("lokasi/{nama_gedung}-{kode_gedung}/{no_lantai}-{kode_lantai}/ruangan/read",[LokasiController::class,"ReadRuangan"])->name("lokasi.ruangan.read");
    Route::post("lokasi/{nama_gedung}-{kode_gedung}/{no_lantai}-{kode_lantai}/ruangan/update/{kode_ruangan}",[LokasiController::class,"UpdateRuangan"])->name("lokasi.ruangan.update");
    Route::delete("lokasi/{nama_gedung}-{kode_gedung}/{no_lantai}-{kode_lantai}/ruangan/delete/{kode_ruangan}",[LokasiController::class,"DeleteRuangan"])->name("lokasi.ruangan.delete");

//    Route::post("lokasi/dbr",[LokasiController::class,"RetrieveLocation"])->name("lokasi.dbr");
Route::post("aset/import",[AsetBarangController::class,"Import"])->name("aset.barang.import");
Route::get("aset/export/{year?}",[AsetBarangController::class,"Export"])->name("aset.barang.export");

    Route::get("aset/barang/detail",[AsetBarangController::class,"get_data_detail"])->name("aset.barang.detail");
    Route::get("aset/barang/{nama_barang}",[AsetBarangController::class,"GetListBarang"])->name("aset.barang.list");
    Route::get("aset/barang/",[AsetBarangController::class,"GetListBarangAll"])->name("aset.barang.all");
    Route::get("aset/barang/detail/{id}",[AsetBarangController::class,"GetDetails"])->name("aset.barang.details.find");
    Route::post("aset/barang/detail",[AsetBarangController::class,"InsertDetailAset"])->name("aset.barang.detail.create");
    Route::post("aset/barang/detail/{id}",[AsetBarangController::class,"UpdateDetailAset"])->name("aset.barang.detail.update");
    Route::delete("aset/barang/detail/{id}",[AsetBarangController::class,"DeleteDetailAset"])->name("aset.barang.detail.delete");
    Route::get("aset/barang/delete/{year}",[AsetBarangController::class,"DeleteDataYears"])->name("aset.barang.delete.year");
    Route::get("aset/DBR",[DBRController::class,"ReadDBR"])->name("aset.barang.dbr");

    Route::post("aset-gedung/import",[AsetGedungController::class,"Import"])->name("aset.gedung.import");
    Route::get("aset-gedung/export/{year?}",[AsetGedungController::class,"Export"])->name("aset.gedung.export");
    Route::get("aset/gedung/pengolahan/{year?}",[PengolahanController::class,"listGedung"])->name("aset.gedung.pengolahan");
    Route::get("aset/gedung/delete/{year}",[AsetGedungController::class,"DeleteDataYears"])->name("aset.gedung.delete.year");

    Route::get("aset/gedung/detail",[AsetGedungController::class,"get_data_detail"])->name("aset.gedung.detail");
    Route::get("aset/gedung/{nama_barang}",[AsetGedungController::class,"GetListGedung"])->name("aset.gedung.list");
    Route::get("aset/gedung/",[AsetGedungController::class,"GetListGedungAll"])->name("aset.gedung.all");
    Route::get("aset/gedung/detail/{id}",[AsetGedungController::class,"GetDetails"])->name("aset.gedung.details.find");
    Route::post("aset/gedung/detail",[AsetGedungController::class,"InsertDetailAset"])->name("aset.gedung.detail.create");
    Route::post("aset/gedung/detail/{id}",[AsetGedungController::class,"UpdateDetailAset"])->name("aset.gedung.detail.update");
    Route::delete("aset/gedung/detail/{id}",[AsetGedungController::class,"DeleteDetailAset"])->name("aset.gedung.detail.delete");

    Route::get("aset/DBR/export",[DBRController::class,"ExportDBR"])->name("DBR.Export");
});


