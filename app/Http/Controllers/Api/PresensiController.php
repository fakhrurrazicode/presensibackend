<?php

namespace App\Http\Controllers\Api;

use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HariJamKerja;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PresensiController extends Controller
{

    public function index(Request $request, $month, $year, $limit = null)
    {
        $user = Auth::user();
        $pegawai = $user->pegawai;

        if ($limit) {
            $presensi = Presensi::where('pegawai_id', $pegawai->id)->orderBy('created_at', 'DESC')->limit($limit)->get();
        } else {
            $presensi = Presensi::where('pegawai_id', $pegawai->id)->orderBy('created_at', 'DESC')->get();
        }


        return response()->json([
            'presensi' => $presensi
        ]);
    }

    public function checkIn(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'pegawai_id' => ['required'],
            'bidang_id' => ['required'],
            'checked_in_at' => ['required'],
            'checked_in_latitude' => ['required'],
            'checked_in_longitude' => ['required'],
            // 'singkatan' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 400);
        }

        $day_of_week = date('N');
        $hari_jam_kerja = HariJamKerja::where('hari_id', $day_of_week)->first();

        $jam_masuk_end = new DateTime($hari_jam_kerja->jam_masuk_end);
        $checked_in_at = new DateTime($hari_jam_kerja->checked_in_at);

        $terlambat = $checked_in_at > $jam_masuk_end ? true : false;

        $data = [
            'pegawai_id' => $request->get('pegawai_id'),
            'bidang_id' => $request->get('bidang_id'),
            'checked_in_at' => $request->get('checked_in_at'),
            'checked_in_latitude' => $request->get('checked_in_latitude'),
            'checked_in_longitude' => $request->get('checked_in_longitude'),
            'presensi' => 'hadir',
            'terlambat' => $terlambat,
        ];

        if ($request->hasFile('checked_in_image')) {
            $path = Storage::disk('public')->put('checked_in_image', $request->file('checked_in_image'));
            $data['checked_in_image'] = $path;
        }

        $presensi = Presensi::create($data);

        return response()->json([
            'message' => 'Check in berhasil',
            'presensi' => $presensi
        ]);
    }

    public function checkOut(Request $request)
    {
        $validation = Validator::make($request->all(), [
            // 'pegawai_id' => ['required'],
            // 'bidang_id' => ['required'],
            'presensi_id' => ['required'],
            'checked_out_at' => ['required'],
            'checked_out_latitude' => ['required'],
            'checked_out_longitude' => ['required'],
            // 'singkatan' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 400);
        }

        $data = [
            'checked_out_at' => $request->get('checked_out_at'),
            'checked_out_latitude' => $request->get('checked_out_latitude'),
            'checked_out_longitude' => $request->get('checked_out_longitude'),
        ];

        if ($request->hasFile('checked_out_image')) {
            $path = Storage::disk('public')->put('checked_out_image', $request->file('checked_out_image'));
            $data['checked_out_image'] = $path;
        }

        $presensi = Presensi::find($request->get('presensi_id'));
        $presensi->update($data);

        return response()->json([
            'message' => 'Check out berhasil',
            'presensi' => $presensi
        ]);
    }
}
