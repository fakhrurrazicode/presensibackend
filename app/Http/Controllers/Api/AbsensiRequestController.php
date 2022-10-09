<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AbsensiRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AbsensiRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $month, $year, $limit = null)
    {
        $user = Auth::user();
        $pegawai = $user->pegawai;

        if ($limit) {
            $absensi_request = AbsensiRequest::where('pegawai_id', $pegawai->id)->orderBy('created_at', 'DESC')->limit($limit)->get();
        } else {
            $absensi_request = AbsensiRequest::where('pegawai_id', $pegawai->id)->orderBy('created_at', 'DESC')->get();
        }


        return response()->json([
            'absensi_request' => $absensi_request
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'pegawai_id' => ['required'],
            'bidang_id' => ['required'],
            'type' => ['required'],
            'request_date' => ['required'],
            'attachment_file' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 400);
        }

        $data = [
            'pegawai_id' => $request->get('pegawai_id'),
            'bidang_id' => $request->get('bidang_id'),
            'type' => $request->get('type'),
            'request_date' => $request->get('request_date'),
            // 'attachment_file' => $request->get('attachment_file'),
        ];

        if ($request->hasFile('attachment_file')) {
            $path = Storage::disk('public')->put('attachment_file', $request->file('attachment_file'));
            $data['attachment_file'] = $path;
        }

        $absensi_request = AbsensiRequest::create($data);

        return response()->json([
            'message' => 'Pengajuan Ketidakhadiran berhasil di kirim, harap menunggu persetujuan dari admin',
            'absensi_request' => $absensi_request
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $absensi_request = AbsensiRequest::find($id);
        $absensi_request->delete();

        return response()->json([
            'absensi_request' => $absensi_request,
        ]);
    }
}
