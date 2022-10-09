<?php

namespace App\Http\Controllers\Api;

use App\Models\HariJamKerja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HariJamKerjaController extends Controller
{


    public function paginated(Request $request)
    {
        $limit = $request->filled('limit') ? $request->get('limit') : 10;
        $offset = $request->filled('offset') ? $request->get('offset') : 0;
        $search = $request->filled('search') ? $request->get('search') : '';
        $sort = $request->filled('sort') ? $request->get('sort') : 'hari_id';
        $order = $request->filled('order') ? $request->get('order') : 'ASC';

        $hari_jam_kerjas = HariJamKerja::where('nama_hari', 'LIKE', '%' . $search . '%');

        $data['total'] = $hari_jam_kerjas->count();

        $hari_jam_kerjas->skip($offset)->limit($limit)->orderBy($sort, $order);

        $data['rows'] = $hari_jam_kerjas->get();

        return $data;
    }

    public function index()
    {

        // return response()->json([]);
        return response()->json(HariJamKerja::all());
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hari_jam_kerja = HariJamKerja::find($id);

        if ($hari_jam_kerja) {
            return response()->json([
                'hari_jam_kerja' => $hari_jam_kerja,
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
            'hari_id' => ['required', 'unique:hari_jam_kerja,hari_id,' . $id],

            'nama_hari' => ['required'],
            'jam_masuk_start' => ['required'],
            'jam_masuk' => ['required'],
            'jam_masuk_end' => ['required'],

            'jam_keluar_start' => ['required'],
            'jam_keluar' => ['required'],
            'jam_keluar_end' => ['required'],

            // 'libur' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 400);
        }

        $hari_jam_kerja = HariJamKerja::find($id);
        $hari_jam_kerja->update($request->all());

        return response()->json([
            'hari_jam_kerja' => $hari_jam_kerja
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
        $hari_jam_kerja = HariJamKerja::find($id);
        $hari_jam_kerja->delete();

        return response()->json([
            'hari_jam_kerja' => $hari_jam_kerja,
        ]);
    }
}
