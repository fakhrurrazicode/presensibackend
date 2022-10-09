<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\HariJamKerjaController;
use App\Http\Controllers\TanggalLiburController;
use App\Http\Controllers\AbsensiRequestController;

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
    // return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/{user}/change_password', [UserController::class, 'change_password'])->name('user.change_password');
Route::put('/user/{user}/update_password', [UserController::class, 'update_password'])->name('user.update_password');
Route::get('/user/paginated', [UserController::class, 'paginated'])->name('user.paginated');
Route::resource('/user', UserController::class);

Route::get('/bidang/paginated', [BidangController::class, 'paginated'])->name('bidang.paginated');
Route::resource('/bidang', BidangController::class);


Route::get('/pegawai/paginated', [PegawaiController::class, 'paginated'])->name('pegawai.paginated');
Route::resource('/pegawai', PegawaiController::class);

Route::get('/presensi/paginated', [PresensiController::class, 'paginated'])->name('presensi.paginated');
Route::resource('/presensi', PresensiController::class);

Route::get('/absensi_request/paginated', [AbsensiRequestController::class, 'paginated'])->name('absensi_request.paginated');
Route::post('/absensi_request/approval', [AbsensiRequestController::class, 'approval'])->name('absensi_request.approval');
Route::resource('/absensi_request', AbsensiRequestController::class);

Route::get('/golongan/paginated', [GolonganController::class, 'paginated'])->name('golongan.paginated');
Route::resource('/golongan', GolonganController::class);

Route::get('/hari_jam_kerja/paginated', [HariJamKerjaController::class, 'paginated'])->name('hari_jam_kerja.paginated');
Route::resource('/hari_jam_kerja', HariJamKerjaController::class);

Route::get('/tanggal_libur/paginated', [TanggalLiburController::class, 'paginated'])->name('tanggal_libur.paginated');
Route::resource('/tanggal_libur', TanggalLiburController::class);

Route::get('/setting/polygon', [SettingController::class, 'polygon'])->name('setting.polygon');
Route::post('/setting/polygon/add', [SettingController::class, 'addPolygonPoint'])->name('setting.polygon.add');
Route::delete('/setting/polygon/remove', [SettingController::class, 'removePolygonPoint'])->name('setting.polygon.remove');

Route::get('/report/rekap_presensi', [ReportController::class, 'rekapPresensiForm'])->name('report.rekap_presensi');
Route::get('/report/rekap_presensi/generate', [ReportController::class, 'rekapPresensiGenerate'])->name('report.rekap_presensi.generate');
