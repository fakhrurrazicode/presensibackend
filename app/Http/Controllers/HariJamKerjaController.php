<?php

namespace App\Http\Controllers;

use App\Models\HariJamKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HariJamKerjaController extends Controller
{
    public function paginated(Request $request)
    {
        $limit = $request->filled('limit') ? $request->get('limit') : 10;
        $offset = $request->filled('offset') ? $request->get('offset') : 0;
        $search = $request->filled('search') ? $request->get('search') : '';
        $sort = $request->filled('sort') ? $request->get('sort') : 'hari_id';
        $order = $request->filled('order') ? $request->get('order') : 'ASC';

        $hari_jam_kerjas = HariJamKerja::where('hari_id', 'LIKE', '%' . $request->get('search') . '%')
            ->orWhere('nama_hari', 'LIKE', '%' . $request->get('search') . '%');

        $data['total'] = $hari_jam_kerjas->count();

        $hari_jam_kerjas->skip($offset)->limit($limit)->orderBy($sort, $order);

        $data['rows'] = $hari_jam_kerjas->get();

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hari_jam_kerja.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hari_jam_kerja.create');
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
            'hari_id' => ['required', 'unique:hari_jam_kerja'],
            'nama_hari' => ['required', 'unique:hari_jam_kerja'],
            'jam_masuk_start' => ['required'],
            // 'jam_masuk' => ['required'],
            'jam_masuk_end' => ['required'],

            'jam_keluar_start' => ['required'],
            // 'jam_keluar' => ['required'],
            'jam_keluar_end' => ['required'],

            // 'libur' => ['required'],
        ]);

        HariJamKerja::create([
            'hari_id' => $request->get('hari_id'),
            'nama_hari' => $request->get('nama_hari'),
            'jam_masuk_start' => $request->get('jam_masuk_start'),
            // 'jam_masuk' => $request->get('jam_masuk'),
            'jam_masuk_end' => $request->get('jam_masuk_end'),

            'jam_keluar_start' => $request->get('jam_keluar_start'),
            // 'jam_keluar' => $request->get('jam_keluar'),
            'jam_keluar_end' => $request->get('jam_keluar_end'),

            'libur' => $request->get('libur'),
        ]);

        return redirect()->route('hari_jam_kerja.index')->with([
            'success' => 'HariJamKerja baru berhasil di tambahkan',
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
    public function edit(HariJamKerja $hari_jam_kerja)
    {
        return view('hari_jam_kerja.edit', ['hari_jam_kerja' => $hari_jam_kerja]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HariJamKerja $hari_jam_kerja)
    {
        $request->validate([
            'hari_id' => ['required', 'unique:hari_jam_kerja,hari_id,' . $hari_jam_kerja->id],
            'nama_hari' => ['required', 'unique:hari_jam_kerja,nama_hari,' . $hari_jam_kerja->id],
            'jam_masuk_start' => ['required'],
            // 'jam_masuk' => ['required'],
            'jam_masuk_end' => ['required'],

            'jam_keluar_start' => ['required'],
            // 'jam_keluar' => ['required'],
            'jam_keluar_end' => ['required'],

            // 'libur' => ['required'],
        ]);

        $hari_jam_kerja->update([
            'hari_id' => $request->get('hari_id'),
            'nama_hari' => $request->get('nama_hari'),
            'jam_masuk_start' => $request->get('jam_masuk_start'),
            // 'jam_masuk' => $request->get('jam_masuk'),
            'jam_masuk_end' => $request->get('jam_masuk_end'),

            'jam_keluar_start' => $request->get('jam_keluar_start'),
            // 'jam_keluar' => $request->get('jam_keluar'),
            'jam_keluar_end' => $request->get('jam_keluar_end'),

            'libur' => $request->get('libur') ? 1 : 0,
        ]);

        return redirect()->route('hari_jam_kerja.index')->with([
            'success' => 'HariJamKerja berhasil di ubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HariJamKerja $hari_jam_kerja)
    {
        $hari_jam_kerja->delete();

        return [
            'status' => true,
            'message' => 'Data hari_jam_kerja ' . $hari_jam_kerja->nama_hari . ' berhasil di hapus',
        ];
    }
}
