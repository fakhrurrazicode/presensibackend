<?php

namespace App\Http\Controllers\Api;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{

    public function paginated(Request $request)
    {
        $limit = $request->filled('limit') ? $request->get('limit') : 10;
        $offset = $request->filled('offset') ? $request->get('offset') : 0;
        $search = $request->filled('search') ? $request->get('search') : '';
        $sort = $request->filled('sort') ? $request->get('sort') : 'id';
        $order = $request->filled('order') ? $request->get('order') : 'DESC';

        $pegawais = Pegawai::with(['bidang', 'golongan'])->where('nip', 'LIKE', '%' . $request->get('search') . '%')
            ->where('nama', 'LIKE', '%' . $request->get('search') . '%');

        $data['total'] = $pegawais->count();

        $pegawais->skip($offset)->limit($limit)->orderBy($sort, $order);

        $data['rows'] = $pegawais->get();

        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pegawai = Pegawai::all();

        return response()->json([
            'pegawai' => $pegawai
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
            'nip' => ['required', 'unique:pegawai,nip'],
            'nama' => ['required'],
            'jenis_kelamin' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'golongan_id' => ['required'],
            'jabatan' => ['required'],
            'bidang_id' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 400);
        }

        $pegawai = Pegawai::create($request->all());

        return response()->json([
            'pegawai' => $pegawai
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
        $pegawai = Pegawai::find($id);

        if ($pegawai) {
            return response()->json([
                'pegawai' => $pegawai,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not found.',
            ], 404);
        }
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
        $validation = Validator::make($request->all(), [
            'nip' => ['required', 'unique:pegawai,nip,' . $id],
            'nama' => ['required'],
            'jenis_kelamin' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'golongan_id' => ['required'],
            'jabatan' => ['required'],
            'bidang_id' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 400);
        }

        $pegawai = Pegawai::find($id);
        $pegawai->update($request->all());

        return response()->json([
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        return response()->json([
            'pegawai' => $pegawai,
        ]);
    }
}
