<?php

use App\Models\HariJamKerja;
use App\Models\PolygonPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BidangController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\GolonganController;
use App\Http\Controllers\Api\PresensiController;
use App\Http\Controllers\Api\HariJamKerjaController;
use App\Http\Controllers\Api\AbsensiRequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Auth

Route::group(['as' => 'api.'], function () {

    Route::post('auth/login', [AuthController::class, 'login']);

    Route::get('initial_data', function () {
        $hari_jam_kerja = HariJamKerja::all();

        return response()->json([
            'hari_jam_kerja' => $hari_jam_kerja
        ]);
    });

    // Route::get('/hari_jam_kerja', [HariJamKerjaController::class, 'index'])->name('hari_jam_kerja.index');

    Route::middleware('auth:api')->group(function () {

        Route::get('/polygon_points', function (Request $request) {
            return PolygonPoint::all();
        });

        Route::get('/auth', [AuthController::class, 'index']);
        Route::put('/auth/update_password', [AuthController::class, 'updatePassword']);

        // Route::get('/user', [UserController::class, 'index']);

        Route::get('/user/paginated', [UserController::class, 'paginated']); //->name('user.paginated');
        Route::resource('/user', UserController::class);
        Route::get('/hari_jam_kerja/paginated', [HariJamKerjaController::class, 'paginated']); //->name('hari_jam_kerja.paginated');
        Route::resource('/hari_jam_kerja', HariJamKerjaController::class);

        Route::get('/bidang/paginated', [BidangController::class, 'paginated']); //->name('bidang.paginated');
        Route::resource('/bidang', BidangController::class);

        // Route::get('/absensi_request/paginated', [AbsensiRequestController::class, 'paginated']); //->name('absensi_request.paginated');
        Route::get('/absensi_request/index/{month}/{year}/{limit?}', [AbsensiRequestController::class, 'index']); //->name('presensi.index');
        Route::resource('/absensi_request', AbsensiRequestController::class)->except('index');

        Route::get('/golongan/paginated', [GolonganController::class, 'paginated']); //->name('golongan.paginated');
        Route::resource('/golongan', GolonganController::class);

        Route::get('/pegawai/paginated', [PegawaiController::class, 'paginated']); //->name('pegawai.paginated');
        Route::resource('/pegawai', PegawaiController::class);


        Route::get('/presensi/index/{month}/{year}/{limit?}', [PresensiController::class, 'index']); //->name('presensi.index');
        Route::post('/presensi/check_in', [PresensiController::class, 'checkIn']); //->name('presensi.check_in');
        Route::post('/presensi/check_out', [PresensiController::class, 'checkOut']); //->name('presensi.check_out');
    });
});
