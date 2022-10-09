<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\AbsensiRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AbsensiRequestController extends Controller
{
    public function paginated(Request $request)
    {
        $limit = $request->filled('limit') ? $request->get('limit') : 10;
        $offset = $request->filled('offset') ? $request->get('offset') : 0;
        $search = $request->filled('search') ? $request->get('search') : '';
        $sort = $request->filled('sort') ? $request->get('sort') : 'absensi_request.id';
        $order = $request->filled('order') ? $request->get('order') : 'DESC';

        $absensi_requests = AbsensiRequest::query();

        $absensi_requests->select('absensi_request.*');

        $absensi_requests->join('pegawai', 'pegawai.id', '=', 'absensi_request.pegawai_id');
        $absensi_requests->join('bidang', 'bidang.id', '=', 'absensi_request.bidang_id');

        $absensi_requests->where(function ($query) use ($search) {
            $query->where('absensi_request.request_date', 'LIKE', '%' . $search . '%');
            $query->where('absensi_request.type', 'LIKE', '%' . $search . '%');

            $query->orWhere('pegawai.nip', 'LIKE', '%' . $search . '%');
            $query->orWhere('pegawai.nama', 'LIKE', '%' . $search . '%');

            $query->orWhere('bidang.kode', 'LIKE', '%' . $search . '%');
            $query->orWhere('bidang.nama', 'LIKE', '%' . $search . '%');
        });

        $data['total'] = $absensi_requests->count();

        $absensi_requests->skip($offset)->limit($limit)->orderBy($sort, $order);
        $absensi_requests->with(['pegawai', 'bidang']);

        $data['rows'] = $absensi_requests->get();

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('absensi_request.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('absensi_request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'pegawai_id' => ['required'],
            // 'bidang_id' => ['required'],
            'type' => ['required'],
            'request_date' => ['required'],
            // 'keterangan' => ['required'],
            // 'approval' => ['required'],
            // 'attachment_file' => ['required'],
        ]);

        $pegawai = Pegawai::find($request->get('pegawai_id'));

        $data = [
            'pegawai_id' => $request->get('pegawai_id'),
            'bidang_id' => $pegawai->bidang_id,
            'type' => $request->get('type'),
            'request_date' => $request->get('request_date'),
            'keterangan' => $request->get('keterangan'),
        ];

        if ($request->hasFile('attachment_file')) {
            $path = Storage::disk('public')->put('attachment_file', $request->file('attachment_file'));
            $data['attachment_file'] = $path;
        }


        $absensi_request = AbsensiRequest::create($data);

        return redirect()->route('absensi_request.index')->with([
            'success' => 'AbsensiRequest baru berhasil di tambahkan',
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
    public function edit(AbsensiRequest $absensi_request)
    {
        return view('absensi_request.edit', ['absensi_request' => $absensi_request]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AbsensiRequest $absensi_request)
    {
        $request->validate([
            'pegawai_id' => ['required'],
            // 'bidang_id' => ['required'],
            'type' => ['required'],
            'request_date' => ['required'],
            // 'keterangan' => ['required'],
            // 'approval' => ['required'],
            // 'attachment_file' => ['required'],
        ]);

        $pegawai = Pegawai::find($request->get('pegawai_id'));

        $data = [
            'pegawai_id' => $request->get('pegawai_id'),
            'bidang_id' => $pegawai->bidang_id,
            'type' => $request->get('type'),
            'request_date' => $request->get('request_date'),
            'keterangan' => $request->get('keterangan'),
        ];

        if ($request->hasFile('attachment_file')) {
            $path = Storage::disk('public')->put('attachment_file', $request->file('attachment_file'));
            $data['attachment_file'] = $path;
        }

        $absensi_request->update($data);

        return redirect()->route('absensi_request.index')->with([
            'success' => 'AbsensiRequest berhasil di ubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbsensiRequest $absensi_request)
    {
        $absensi_request->delete();

        return [
            'status' => true,
            'message' => 'Data absensi_request ' . $absensi_request->nama . ' berhasil di hapus',
        ];
    }

    public function approval(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id' => ['required'],
            'approval' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ]);
        }

        $absensi_request = AbsensiRequest::find($request->get('id'));
        $pegawai = $absensi_request->pegawai;
        $user = $pegawai->user;

        $absensi_request->update([
            'approval' => $request->get('approval'),
            'alasan_penolakan' => $request->get('approval') ? '' : $request->get('alasan_penolakan'),
        ]);

        $headers = [
            'Authorization' => 'key=' . env('CLOUD_MESSAGING_API_SERVER_KEY'),
            'Content-Type' => 'application/json',
        ];
        $data = [
            "registration_ids" => [$user->fcm_token],
            "notification" => [
                "title" => 'Presensi App',
                "body" => 'Pengajuan Ketidakhadiran di ' . ($request->get('approval') ? 'setujui' : 'tolak dengan alasan: ' . $request->get('alasan_penolakan')),
            ]
        ];
        $fcm_response = Http::withHeaders($headers)->post('https://fcm.googleapis.com/fcm/send', $data);

        return response()->json([
            'absensi_request' => $absensi_request,
            'data' => $data,
            'headers' => $headers,
            'fcm_response' => $fcm_response->json(),
        ]);
    }
}
