<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GolonganController extends Controller
{
    public function paginated(Request $request)
    {
        $limit = $request->filled('limit') ? $request->get('limit') : 10;
        $offset = $request->filled('offset') ? $request->get('offset') : 0;
        $search = $request->filled('search') ? $request->get('search') : '';
        $sort = $request->filled('sort') ? $request->get('sort') : 'id';
        $order = $request->filled('order') ? $request->get('order') : 'DESC';

        $golongans = Golongan::where('golongan', 'LIKE', '%' . $request->get('search') . '%')
            ->orWhere('nama_pangkat', 'LIKE', '%' . $request->get('search') . '%');

        $data['total'] = $golongans->count();

        $golongans->skip($offset)->limit($limit)->orderBy($sort, $order);

        $data['rows'] = $golongans->get();

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('golongan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('golongan.create');
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
            'golongan' => ['required', 'unique:golongan'],
            'nama_pangkat' => ['required'],
        ]);

        Golongan::create([
            'golongan' => $request->get('golongan'),
            'nama_pangkat' => $request->get('nama_pangkat'),
        ]);

        return redirect()->route('golongan.index')->with([
            'success' => 'Golongan baru berhasil di tambahkan',
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
    public function edit(Golongan $golongan)
    {
        return view('golongan.edit', ['golongan' => $golongan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Golongan $golongan)
    {
        $request->validate([
            'golongan' => ['required', 'unique:golongan,golongan,' . $golongan->id],
            'nama_pangkat' => ['required'],
        ]);

        $golongan->update([
            'golongan' => $request->get('golongan'),
            'nama_pangkat' => $request->get('nama_pangkat'),
        ]);

        return redirect()->route('golongan.index')->with([
            'success' => 'Golongan berhasil di ubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Golongan $golongan)
    {
        $golongan->delete();

        return [
            'status' => true,
            'message' => 'Data golongan ' . $golongan->nama_pangkat . ' berhasil di hapus',
        ];
    }
}
