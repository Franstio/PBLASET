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
    Route::get("pengolahan",[PengolahanController::class,'list'])->name("pengolahan");
    Route::get("DBR",[DBRController::class,"index"])->name("DBR");

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


    Route::get('gedung',[AsetGedungController::class,"master_index"])->name("master.gedung");
    Route::post('gedung/create',[AsetGedungController::class,"tambah_data_master"])->name("master.gedung.create");
    Route::get('gedung/read',[AsetGedungController::class,"get_data_master"])->name("master.gedung.read");
    Route::post('gedung/update/{kode_gedung}',[AsetGedungController::class,"update_data_master"])->name("master.gedung.update");
    Route::delete('gedung/delete/{kode_gedung}',[AsetGedungController::class,'delete_data_master'])->name('master.gedung.delete');

    Route::get("lokasi",[LokasiController::class,"index"])->name("lokasi");
    Route::post("lokasi/gedung",[LokasiController::class,"CreateGedung"])->name("lokasi.gedung.create");
    Route::get("lokasi/gedung/read",[LokasiController::class,"ReadGedung"])->name("lokasi.gedung.read");
    Route::post("lokasi/gedung/update/{kode_gedung}",[LokasiController::class,"UpdateGedung"])->name("lokasi.gedung.update");
    Route::delete("lokasi/gedung/delete/{kode_gedung}",[LokasiController::class,"DeleteGedung"])->name("lokasi.gedung.delete");

});
